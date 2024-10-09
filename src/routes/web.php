<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/api/orders/{id}', 'show');
    Route::post('/api/orders', 'store');
});
