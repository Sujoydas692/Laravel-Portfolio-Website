<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'homeIndex']);


Route::get("/visitor", [VisitorController::class, 'visitorIndex']);
Route::get("/getVisitorData", [VisitorController::class, 'getVisitorData']);

//Admin Panel Service Management
Route::get("/services", [ServicesController::class, 'ServicesIndex']);
Route::get("/getServicesData", [ServicesController::class, 'getServiceData']);
Route::post("/ServiceDelete", [ServicesController::class, 'serviceDelete']);
Route::post("/ServiceDetails", [ServicesController::class, 'getServiceDetails']);
Route::post("/ServiceUpdate", [ServicesController::class, 'serviceUpdate']);
Route::post("/ServiceAdd", [ServicesController::class, 'serviceAdd']);

//Admin Panel Course Management
Route::get("/courses", [CoursesController::class, 'CoursesIndex']);
Route::get("/getCoursesData", [CoursesController::class, 'getCoursesData']);
Route::post("/CourseDelete", [CoursesController::class, 'courseDelete']);
Route::post("/CoursesDetails", [CoursesController::class, 'getCoursesDetails']);
Route::post("/CourseUpdate", [CoursesController::class, 'courseUpdate']);
Route::post("/CourseAdd", [CoursesController::class, 'courseAdd']);

//Admin Panel Project Management
Route::get("/projects", [ProjectsController::class, 'ProjectsIndex']);
Route::get("/getProjectsData", [ProjectsController::class, 'getProjectsData']);
Route::post("/ProjectDelete", [ProjectsController::class, 'projectDelete']);
Route::post("/ProjectsDetails", [ProjectsController::class, 'getProjectsDetails']);
Route::post("/ProjectUpdate", [ProjectsController::class, 'projectUpdate']);
Route::post("/ProjectAdd", [ProjectsController::class, 'projectAdd']);

//Admin Panel Contacts Management
Route::get("/contacts", [ContactsController::class, 'ContactsIndex']);
Route::get("/getContactsData", [ContactsController::class, 'getContactsData']);
Route::post("/contactDelete", [ContactsController::class, 'contactDelete']);