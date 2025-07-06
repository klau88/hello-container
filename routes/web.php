<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'));
Route::get('orders/unprocessed', [OrderController::class, 'unprocessed'])->name('orders.unprocessed');
Route::resource('orders', OrderController::class);
