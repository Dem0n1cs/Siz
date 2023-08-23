<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\PersonalCard;
use App\Http\Requests\StorePersonalCardRequest;
use App\Http\Requests\UpdatePersonalCardRequest;
use App\Models\Profession;


class PersonalCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personalCards = Branch::with(['departments:id,branch_id,title'=> ['divisions:id,department_id,full_title']])->select('id','title')->get();
        return view('personal-card.index',compact('personalCards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professions = Profession::with(['standards:id,ppe_id,profession_id,term_wear'=> ['ppe:id,classification_id,title'=>['classification:id,title']]])->select('id')->get();
/*dd($professions);*/
        return view('personal-card.create',compact('professions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonalCardRequest $request)
    {
        //
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
    public function edit(PersonalCard $personalCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonalCardRequest $request, PersonalCard $personalCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalCard $personalCard)
    {
        //
    }
}
