<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/wall',[DashboardController::class,'index'])->name('offerwall');
Route::get('/track',[DashboardController::class,'track'])->name('track');
Route::get('/update-conversion',[DashboardController::class,'updateConversion'])->name('updateconversion');
Route::post('/contact',[DashboardController::class,'submitContact'])->name('contact.submit');

