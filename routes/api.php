<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderApiController;

Route::get('/orders', [OrderApiController::class, 'index'])->name('api.orders.index');
Route::post('/orders/create', [OrderApiController::class, 'create'])->name('api.orders.create');
