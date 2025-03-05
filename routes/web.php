<?php

use App\Http\Controllers\RandomNumberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lab1', function () {
    return view('lab1');
});
Route::get('/get-random-number', [RandomNumberController::class, 'getRandomNumber']);
