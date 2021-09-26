<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'homeIndex']);


Route::get("/visitor", [VisitorController::class, 'visitorIndex']);
Route::get("/getVisitorData", [VisitorController::class, 'getVisitorData']);


Route::get("/services", [ServicesController::class, 'ServicesIndex']);
Route::get("/getServicesData", [ServicesController::class, 'getServiceData']);
Route::post("/ServiceDelete", [ServicesController::class, 'serviceDelete']);
Route::post("/ServiceDetails", [ServicesController::class, 'getServiceDetails']);
Route::post("/ServiceUpdate", [ServicesController::class, 'serviceUpdate']);