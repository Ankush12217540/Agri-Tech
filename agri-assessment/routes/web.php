<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\LandHoldingController;
use App\Http\Controllers\IrrigationSourceController;
use App\Http\Controllers\CropPatternController;
use App\Http\Controllers\WellController;
use App\Http\Controllers\CroppingPatternController;

/*
|--------------------------------------------------------------------------- 
| Web Routes
|--------------------------------------------------------------------------- 
| 
| Here is where you can register web routes for your application.
| All resource routes are defined below. Ensure that corresponding 
| controller methods and Blade views exist to make them accessible.
| 
*/

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// Region CRUD
Route::resource('regions', RegionController::class);

// Farmer CRUD
Route::resource('farmers', FarmerController::class);

// Landholding CRUD
Route::resource('landholding', LandHoldingController::class);

// Graph for Landholding
Route::get('landholding/graph', [LandHoldingController::class, 'showGraph'])->name('landholding.graph');

// Irrigation Sources CRUD
Route::resource('irrigationsources', IrrigationSourceController::class);

// Route to display the form for selecting crops and techniques (GET request)
Route::get('irrigationsources/form', [IrrigationSourceController::class, 'createForm'])->name('irrigationsources.form');

// Route for submitting selected crops and techniques (POST request)
Route::post('irrigationsources/submit', [IrrigationSourceController::class, 'submit'])->name('irrigationsources.submit');

// Cropping Patterns CRUD
Route::resource('croppingpatterns', CroppingPatternController::class);

// Wells CRUD (Added resource route for WellController)
Route::resource('wells', WellController::class);

