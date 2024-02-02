<?php

namespace App\Http\Controllers;

use App\Models\Ppe;
use App\Models\Profession;
use App\Http\Requests\StoreProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professions = Profession::select('id', 'title')->get();
        return view('profession.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ppes = Ppe::with('classification:id,title')->select('id','classification_id','title')->get();
        return view('profession.create', compact('ppes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessionRequest $request)
    {
        DB::transaction(function () use ($request) {
            $profession = Profession::create($request->validated('professions'));
            $profession->standards()->createMany($request->validated('standards'));
        });
        return redirect()->route('profession.index')->with('success', 'Данные сохранены!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profession $profession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profession $profession)
    {
        $ppes = Ppe::with('classification:id,title')
            ->select('ppes.classification_id','ppes.id as equipment_id', 'standards.id','standards.ppe_id', 'ppes.title', 'standards.quantity', 'standards.term_wear')
            ->leftjoin('standards', function (JoinClause $join) use ($profession) {
                $join->on('ppes.id', '=', 'standards.ppe_id')
                    ->where('standards.profession_id', '=', $profession->id);
            })->get();

        return view('profession.edit', compact('profession','ppes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessionRequest $request, Profession $profession)
    {
        DB::transaction(function () use ($request,$profession) {
            $profession->update($request->validated('professions'));
            $profession->standards()->sync($request->validated('standards'));
        });
        return redirect()->route('profession.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profession $profession)
    {
        $profession->delete();
        return redirect()->route('profession.index')->with('success', 'Данные удалены');
    }
}
