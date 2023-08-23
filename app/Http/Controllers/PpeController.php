<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Ppe;
use App\Http\Requests\StorePpeRequest;
use App\Http\Requests\UpdatePpeRequest;

class PpeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ppes = Ppe::with('classification:id,title')->select('id','classification_id','title')->get();
        return view('ppe.index', compact('ppes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classifications = Classification::pluck('title','id');
        return view('ppe.create',compact('classifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePPeRequest $request)
    {
        Ppe::create($request->validated());
        return redirect()->route('ppe.index')->with('success', 'Данные сохранены!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ppe $ppe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ppe $ppe)
    {
        $classifications = Classification::pluck('title','id');
        return view('ppe.edit', compact('ppe','classifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePpeRequest $request, Ppe $ppe)
    {
        $ppe->update($request->validated());
        return redirect()->route('ppe.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ppe $ppe)
    {
        $ppe->delete();
        return redirect()->route('ppe.index')->with('success', 'Данные удалены');
    }
}
