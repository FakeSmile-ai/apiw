<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;


Route::get('/ping', fn () => response()->json(['ok' => true]));


Route::apiResource('clients', ClientController::class);
