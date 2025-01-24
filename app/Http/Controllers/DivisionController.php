<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Http\Requests\StoreDivisionRequest;
use App\Http\Requests\UpdateDivisionRequest;
use Illuminate\Support\Facades\Hash;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::query()->with('department:id,title')->get();
        return view('division.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::query()->pluck('title','id');
        return view('division.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDivisionRequest $request)
    {
        Division::query()->create($request->validated());
        return redirect()->route('division.index')->with('success', 'Данные сохранены!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        $departments = Department::query()->pluck('title','id');
        return view('division.edit', compact('division','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDivisionRequest $request, Division $division)
    {
        $division->update($request->validated());
        return redirect()->route('division.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route('division.index')->with('success', 'Данные удалены');
    }
}
