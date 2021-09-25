<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'homeIndex']);
Route::get("/visitor", [VisitorController::class, 'visitorIndex']);
