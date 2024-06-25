<?php

use App\Http\Controllers\CurrencyConvertController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

// This route maps the root URL ("/") to the index method of the CurrencyConvertController class.
Route::get('/', [CurrencyConvertController::class, 'index']);

// This route maps the "/convert" URL to the convert method of the CurrencyConvertController class.
Route::post('/convert', [CurrencyConvertController::class, 'convert']);
