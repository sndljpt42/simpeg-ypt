<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TendikController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('dosen', DosenController::class);
Route::resource('tendik', TendikController::class);