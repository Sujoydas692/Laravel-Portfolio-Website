<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TermsController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'homeIndex']);
Route::post("/contactSend", [HomeController::class, 'ContactSend']);


Route::get("/courses", [CoursesController::class, 'CoursePage']);
Route::get("/policy", [PolicyController::class, 'PolicyPage']);
Route::get("/projects", [ProjectsController::class, 'ProjectPage']);
Route::get("/terms", [TermsController::class, 'TermsPage']);
Route::get("/contact", [ContactController::class, 'ContactPage']);
