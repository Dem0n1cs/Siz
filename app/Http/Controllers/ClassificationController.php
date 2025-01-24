<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Http\Requests\StoreClassificationRequest;
use App\Http\Requests\UpdateClassificationRequest;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classifications = Classification::query()->select('id','title')->get();
        return view('classification.index', compact('classifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassificationRequest $request)
    {
        Classification::query()->create($request->validated());
        return redirect()->route('classification.index')->with('success', 'Данные сохранены!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classification $classification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classification $classification)
    {
        return view('classification.edit', compact('classification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassificationRequest $request, Classification $classification)
    {
        $classification->update($request->validated());
        return redirect()->route('classification.index')->with('success', 'Данные обновлены!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classification $classification)
    {
        $classification->delete();
        return redirect()->route('classification.index')->with('success', 'Данные удалены');
    }
}
