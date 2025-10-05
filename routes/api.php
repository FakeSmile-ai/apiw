<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;

Route::apiResource('clients', ClientController::class);
Route::apiResource('products', ProductController::class);
