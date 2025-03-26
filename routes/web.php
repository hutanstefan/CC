<?php

use App\Http\Controllers\RandomNumberController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homework2');
});

Route::get('/lab1', function () {
    return view('lab1');
});
Route::get('/get-random-number', [RandomNumberController::class, 'getRandomNumber']);
Route::get('/get-news', [NewsController::class, 'getNews']);

Route::get('/lab2', function () {
    return view('lab2');
});
