<?php

use App\Http\Controllers\ClothingSizeController;
use App\Http\Controllers\GeneratePdfPersonalCardController;
use App\Http\Controllers\HeightController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PersonalCardController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(['auth','permission'])->group(function () {
    Route::resource('branch', App\Http\Controllers\BranchController::class)->except('show');
    Route::resource('department', App\Http\Controllers\DepartmentController::class)->except('show');
    Route::resource('division', App\Http\Controllers\DivisionController::class)->except('show');
    Route::resource('classification', App\Http\Controllers\ClassificationController::class)->except('show');
    Route::resource('ppe', App\Http\Controllers\PpeController::class)->except('show');
    Route::resource('profession', App\Http\Controllers\ProfessionController::class)->except('show');
    Route::get('personal_card/{user}', [PersonalCardController::class, 'create'])->name('personal_card.create');
    Route::get('/download/{user}', [PersonalCardController::class, 'download'])->name('personal_card.download');
    Route::resource('personal_card', App\Http\Controllers\PersonalCardController::class)->except('show','create');
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class)->except('show');
    Route::resource('users', UserController::class)->except('show');
    Route::resource('heights', HeightController::class)->except('show');
    Route::resource('clothing_sizes', ClothingSizeController::class)->except('show');
});


