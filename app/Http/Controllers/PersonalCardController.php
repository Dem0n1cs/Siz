<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ClothingSize;
use App\Models\Height;
use App\Models\PersonalCard;
use App\Models\User;
use App\Http\Requests\StorePersonalCardRequest;
use App\Http\Requests\UpdatePersonalCardRequest;
use App\Services\CustomTemplateProcessor;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;


class PersonalCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $personalCards = Branch::query()->with(['departments:id,branch_id,title' =>
            ['divisions:id,department_id,full_title' =>
                ['user:id,last_name,first_name,middle_name,division_id,profession_id,boss_id' =>
                    ['profession:id', 'personalcard:id,user_id']]
            ]])->select('id', 'title')->get();
        return view('personal-card.index', compact('personalCards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user->load(
            ['profession:id,title' => [
                'standards:id,profession_id,ppe_id,quantity,term_wear' => ['ppe:id,classification_id,title' => ['classification:id,title']]],
                'division:id,department_id,short_title,full_title' => ['department:id,branch_id,title' => ['branch:id,title']]
            ]);
        $heights = Height::query()->pluck('height_range', 'id');
        $clothingSizes = ClothingSize::query()->pluck('size_range', 'id');
        return view('personal-card.create', compact('user', 'heights', 'clothingSizes'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws Throwable
     */
    public function store(StorePersonalCardRequest $request)
    {
        DB::transaction(function () use ($request) {
            $personalCard = PersonalCard::query()->create($request->safe()->only('user_id'));
            $personalCard->frontSide()->create($request->validated('front_side'));
            foreach ($request->validated('reverse_side_gives') as $index => $reverseSideGiveData) {
                if ($request->hasFile('reverse_side_gives.' . $index . '.signature')) {
                    $filePath = Storage::disk('public')->put($personalCard->user->test_first, request()->file('reverse_side_gives.' . $index . '.signature'));
                    $reverseSideGiveData['signature'] = $filePath;
                }
                $reverseSideGive = $personalCard->reserveSideGives()->create($reverseSideGiveData);
                if (isset($request->input('reverse_side_returns')[$index])) {
                    $reverseSideReturnData = $request->validated('reverse_side_returns')[$index];
                    if ($request->hasFile('reverse_side_returns.' . $index . '.signatures')) {
                        $filePath = Storage::disk('public')->put($personalCard->user->test_first, request()->file('reverse_side_returns.' . $index . '.signatures'));
                        $reverseSideReturnData['signatures'] = $filePath;
                    }
                    $reverseSideGive->reverseSideReturn()->create($reverseSideReturnData);
                }
            }
        });
        return redirect()->route('personal_card.index')->withSuccess(__('Личная карточка создана'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonalCard $personalCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersonalCard $personalCard): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $personalCard->load(['user:id,last_name,first_name,middle_name,division_id,profession_id,employment' =>
            ['profession:id,title' =>
                ['standards:id,profession_id,ppe_id,quantity,term_wear' =>
                    ['ppe:id,classification_id,title' =>
                        ['classification:id,title']]]],
            'frontSide:id,personal_card_id,gender,height_id,clothing_size_id,shoe_size,glove_size,corrective_glasses',
            'reserveSideGives:id,personal_card_id,ppe_id,date,quantity,percentage_wear,cost,signature' => [
                'reverseSideReturn:id,reverse_side_give_id,date,quantity,percentage_wear,cost,signatures']]);
        $heights = Height::query()->pluck('height_range', 'id');
        $clothingSizes = ClothingSize::query()->pluck('size_range', 'id');
        return view('personal-card.edit', compact('personalCard', 'heights', 'clothingSizes'));
    }

    /**
     * Update the specified resource in storage.
     * @throws Throwable
     */
    public function update(UpdatePersonalCardRequest $request, PersonalCard $personalCard)
    {
        DB::transaction(function () use ($personalCard, $request) {
            $personalCard->frontSide()->update($request->validated('front_side'));
            foreach ($request->validated('reverse_side_gives') as $index => $reverseSideGiveData) {
                if ($request->hasFile('reverse_side_gives.' . $index . '.signature')) {
                    $filePath = Storage::disk('public')->put($personalCard->user->test_first, request()->file('reverse_side_gives.' . $index . '.signature'));
                    $reverseSideGiveData['signature'] = $filePath;
                }
                $reverseSideGive = $personalCard->reserveSideGives()->updateOrCreate(Arr::only($reverseSideGiveData, ['id']), Arr::except($reverseSideGiveData, ['id']));
                if (isset($request->input('reverse_side_returns')[$index])) {
                    $reverseSideReturnData = $request->validated('reverse_side_returns')[$index];
                    if ($request->hasFile('reverse_side_returns.' . $index . '.signatures')) {
                        $filePath = Storage::disk('public')->put($personalCard->user->test_first, request()->file('reverse_side_returns.' . $index . '.signatures'));
                        $reverseSideReturnData['signatures'] = $filePath;
                    }
                    $reverseSideGive->reverseSideReturn()->updateOrCreate(Arr::only($reverseSideReturnData, ['id']), Arr::except($reverseSideReturnData, ['id']));
                }
            }
        });
        return redirect()->route('personal_card.index')->withSuccess(__('Личная карточка обновлена'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalCard $personalCard): void
    {
        $personalCard->delete();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function download(User $user)
    {
        $templatePath = resource_path('templates/personalCard.docx');

        $templateProcessor = new CustomTemplateProcessor($templatePath);

        $user->load(
            [
                'profession:id,title' =>
                    ['standards:id,profession_id,ppe_id,quantity,term_wear' =>
                        ['ppe:id,classification_id,title' =>
                            ['classification:id,title']
                        ]
                    ],
                'personalCard:id,user_id' =>
                    ['frontSide:id,personal_card_id,gender,height_id,clothing_size_id,shoe_size' =>
                        ['height:id,height_range', 'clothingSize:id,size_range'],
                        'reserveSideGives:id,personal_card_id,ppe_id,date,quantity,percentage_wear,cost,signature' =>
                            ['ppe:id,title,classification_id'=>
                                ['classification:id,title'],
                                'reverseSideReturn:id,reverse_side_give_id,date,quantity,percentage_wear,cost,signatures'
                            ]

                    ]
            ],
            'division:id,short_title',
            'boss:id,boss_position'
        );

        $templateProcessor->setValue('employee_number', $user->employee_number);
        $templateProcessor->setValue('last_name', $user->last_name);
        $templateProcessor->setValue('first_name', $user->first_name);
        $templateProcessor->setValue('middle_name', $user->middle_name);
        $templateProcessor->setValue('profession_name', $user->profession->title);
        $templateProcessor->setValue('division_name', $user->division->short_title);
        $templateProcessor->setValue('employment', $user->employment_human);
        $templateProcessor->setValue('height', $user->personalCard->frontSide->height->height_range);
        $templateProcessor->setValue('gender', $user->personalCard->frontSide->gender);
        $templateProcessor->setValue('clothing_size', $user->personalCard->frontSide->clothingSize->size_range);

        $templateProcessor->setValue('shoe_size', $user->personalCard->frontSide->shoe_size);
        $templateProcessor->setValue('boss_position', $user->boss->boss_position);
        $templateProcessor->setValue('boss_name', $user->boss->full_name);
        $templateProcessor->setValue('full_name', $user->full_name);


        $standards = $user->profession->standards;
        $front = [];
        foreach ($standards as $index => $standard) {
            $front['ppe_title_front#' . ($index + 1)] = $standard->ppe->title;
            $front['classification_title_front#' . ($index + 1)] = $standard->ppe->classification->title;
            $front['quantity_front#' . ($index + 1)] = $standard->quantity;
            $front['term_wear_front#' . ($index + 1)] = $standard->term_wear;
        }

        $templateProcessor->cloneRow('ppe_title_front', count($standards));

        foreach ($front as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }

        $reverse = [];
        $gives = $user->personalCard->reserveSideGives;

        if ($gives->isNotEmpty()) {

            foreach ($gives as $index => $give) {
                $reverse['col1#' . ($index + 1)] = (string)$give->ppe->title ?? '';
                $reverse['col2#' . ($index + 1)] = (string)$give->ppe->classification->title ?? '';
                $reverse['col3#' . ($index + 1)] = (string)$give->date ? date('d.m.Y', strtotime($give->date)) : '';
                $reverse['col4#' . ($index + 1)] = (string)$give->quantity ?? '';
                $reverse['col5#' . ($index + 1)] = (string)$give->percentage_wear ?? '';
                $reverse['col6#' . ($index + 1)] = (string)$give->cost ?? '';

                $return = $give->reverseSideReturn;
                    $reverse['col8#' . ($index + 1)] = (string)$return->date ? date('d.m.Y', strtotime($return->date)) : '';
                    $reverse['col9#' . ($index + 1)] = (string)$return->quantity ?? '';
                    $reverse['col10#' . ($index + 1)] = (string)$return->percentage_wear ?? '';
                    $reverse['col11#' . ($index + 1)] = (string)$return->cost ?? '';
                }
            }

            $templateProcessor->cloneRow('col1', count($gives));

            foreach ($reverse as $key => $value) {
                $templateProcessor->setValue($key, (string)$value);
            }

        $outputPath = storage_path("app/generated_documents/{$user->full_name}.docx");
        $templateProcessor->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend();
    }

}
