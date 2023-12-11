<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomersekletController;
use App\Http\Controllers\UHSzenzorController;
use App\Http\Controllers\LedController;

Route::get('/', function () {
    return view('welcome');
})->name("fooldal");

Route::get('/homerseklet',[HomersekletController::class,'index'])->name('homerseklet');

Route::get('/uhszenzor',[UHSzenzorController::class,'index'])->name('uhszenzor');

Route::get('/ledkapcsolo',[LedController::class,'index'])->name('ledkapcsolo');

Route::post('/ledsenddata',[LedController::class,'ledsenddata'])->name('ledsenddata');

