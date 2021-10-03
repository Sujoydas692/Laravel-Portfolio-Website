<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'homeIndex']);
Route::post("/contactSend", [HomeController::class, 'ContactSend']);
