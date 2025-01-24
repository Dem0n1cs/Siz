<?php

namespace App\Http\Controllers;

use App\Models\ClothingSize;
use App\Http\Requests\StoreClothingSizeRequest;
use App\Http\Requests\UpdateClothingSizeRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ClothingSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $clothingSizes = ClothingSize::query()->select('id','size_range')->get();
        return view('clothing-sizes.index', compact('clothingSizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('clothing-sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClothingSizeRequest $request): RedirectResponse
    {
        ClothingSize::query()->create($request->validated());
        return redirect()->route('clothing_sizes.index')->with('success', 'Size created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClothingSize $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClothingSize $clothingSize): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('clothing-sizes.edit', compact('clothingSize'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClothingSizeRequest $request, ClothingSize $clothingSize): RedirectResponse
    {
        $clothingSize->update($request->validated());
        return redirect()->route('clothing_sizes.index')->with('success', 'Size updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClothingSize $clothingSize): RedirectResponse
    {
        $clothingSize->delete();
        return redirect()->route('clothing_sizes.index')->with('success', 'Size deleted successfully.');
    }
}
