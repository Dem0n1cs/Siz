<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::resource('branch', App\Http\Controllers\BranchController::class)->except('show');
Route::resource('department', App\Http\Controllers\DepartmentController::class)->except('show');
Route::resource('division', App\Http\Controllers\DivisionController::class)->except('show');
Route::resource('classification', App\Http\Controllers\ClassificationController::class)->except('show');
Route::resource('equipment', App\Http\Controllers\EquipmentController::class)->except('show');
Route::resource('profession', App\Http\Controllers\ProfessionController::class)->except('show');


