<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrpcController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/match-result/{id}', [ GrpcController::class, 'getMatchResult']);