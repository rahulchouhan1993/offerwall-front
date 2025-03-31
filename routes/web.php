<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/wall',[DashboardController::class,'index'])->name('offerwall');
Route::get('/track',[DashboardController::class,'track'])->name('track');
Route::get('/update-conversion',[DashboardController::class,'updateConversion'])->name('updateconversion');
Route::get('/server-postbacks',[DashboardController::class,'serverPostbacks'])->name('serverpostbacks');
Route::post('/contact',[DashboardController::class,'submitContact'])->name('contact.submit');
Route::get('/check-cookie', [DashboardController::class, 'checkAndSetCookie']);
Route::get('/completedOffers', [DashboardController::class, 'completedOffers'])->name('completedOffers');
Route::get('/blocked',[DashboardController::class,'blocked'])->name('blocked');


