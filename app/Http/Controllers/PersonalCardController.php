<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\PersonalCard;
use App\Models\User;
use App\Http\Requests\StorePersonalCardRequest;
use App\Http\Requests\UpdatePersonalCardRequest;
use Barryvdh\Debugbar\Facades\Debugbar;
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
        $personalCards = Branch::with(['departments:id,branch_id,title' =>
            ['divisions:id,department_id,full_title' =>
                ['user:id,last_name,first_name,middle_name,division_id,profession_id' =>
                    ['profession:id', 'personalcard:id,user_id']]
            ]])->select('id', 'title')->get();
        Debugbar::info($personalCards);
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
        return view('personal-card.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws Throwable
     */
    public function store(StorePersonalCardRequest $request)
    {
        DB::transaction(function () use ($request) {
            $personalCard = PersonalCard::create($request->safe()->only('user_id'));
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
            'frontSide:id,personal_card_id,gender,growth,clothing_size,shoe_size,glove_size,corrective_glasses',
            'reserveSideGives:id,personal_card_id,ppe_id,date,quantity,percentage_wear,cost,signature' => [
                'reverseSideReturn:id,reverse_side_give_id,date,quantity,percentage_wear,cost,signatures']]);
        return view('personal-card.edit', compact('personalCard'));
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

}
