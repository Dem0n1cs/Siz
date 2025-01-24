<?php

namespace App\Http\Controllers;

use App\Models\Height;
use App\Http\Requests\StoreHeightRequest;
use App\Http\Requests\UpdateHeightRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class HeightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rangeHeights = Height::query()->select('id', 'height_range')->get();
        return view('heights.index', compact('rangeHeights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('heights.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeightRequest $request): RedirectResponse
    {
        Height::query()->create($request->validated());
        return redirect()->route('heights.index')->with('success', 'Данные сохранены!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Height $height)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Height $height): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('heights.edit', compact('height'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeightRequest $request, Height $height): RedirectResponse
    {
        $height->update($request->validated());
        return redirect()->route('heights.index')->with('success', 'Данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Height $height): RedirectResponse
    {
        $height->delete();
        return redirect()->route('heights.index')->with('success', 'Запись удалена');
    }
}
