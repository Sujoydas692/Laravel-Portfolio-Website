<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginRegistraitonCOntroller;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'homeIndex'])->middleware('LoginCheck');


Route::get("/visitor", [VisitorController::class, 'visitorIndex'])->middleware('LoginCheck');
Route::get("/getVisitorData", [VisitorController::class, 'getVisitorData'])->middleware('LoginCheck');

//Admin Panel Service Management
Route::get("/services", [ServicesController::class, 'ServicesIndex'])->middleware('LoginCheck');
Route::get("/getServicesData", [ServicesController::class, 'getServiceData'])->middleware('LoginCheck');
Route::post("/ServiceDelete", [ServicesController::class, 'serviceDelete'])->middleware('LoginCheck');
Route::post("/ServiceDetails", [ServicesController::class, 'getServiceDetails'])->middleware('LoginCheck');
Route::post("/ServiceUpdate", [ServicesController::class, 'serviceUpdate'])->middleware('LoginCheck');
Route::post("/ServiceAdd", [ServicesController::class, 'serviceAdd'])->middleware('LoginCheck');

//Admin Panel Course Management
Route::get("/courses", [CoursesController::class, 'CoursesIndex'])->middleware('LoginCheck');
Route::get("/getCoursesData", [CoursesController::class, 'getCoursesData'])->middleware('LoginCheck');
Route::post("/CourseDelete", [CoursesController::class, 'courseDelete'])->middleware('LoginCheck');
Route::post("/CoursesDetails", [CoursesController::class, 'getCoursesDetails'])->middleware('LoginCheck');
Route::post("/CourseUpdate", [CoursesController::class, 'courseUpdate'])->middleware('LoginCheck');
Route::post("/CourseAdd", [CoursesController::class, 'courseAdd'])->middleware('LoginCheck');

//Admin Panel Project Management
Route::get("/projects", [ProjectsController::class, 'ProjectsIndex'])->middleware('LoginCheck');
Route::get("/getProjectsData", [ProjectsController::class, 'getProjectsData'])->middleware('LoginCheck');
Route::post("/ProjectDelete", [ProjectsController::class, 'projectDelete'])->middleware('LoginCheck');
Route::post("/ProjectsDetails", [ProjectsController::class, 'getProjectsDetails'])->middleware('LoginCheck');
Route::post("/ProjectUpdate", [ProjectsController::class, 'projectUpdate'])->middleware('LoginCheck');
Route::post("/ProjectAdd", [ProjectsController::class, 'projectAdd'])->middleware('LoginCheck');

//Admin Panel Contacts Management
Route::get("/contacts", [ContactsController::class, 'ContactsIndex'])->middleware('LoginCheck');
Route::get("/getContactsData", [ContactsController::class, 'getContactsData'])->middleware('LoginCheck');
Route::post("/contactDelete", [ContactsController::class, 'contactDelete'])->middleware('LoginCheck');

//Admin Panel Review Management
Route::get("/review", [ReviewController::class, 'ReviewIndex'])->middleware('LoginCheck');
Route::get("/getReviewData", [ReviewController::class, 'getReviewData'])->middleware('LoginCheck');
Route::post("/ReviewDelete", [ReviewController::class, 'reviewDelete'])->middleware('LoginCheck');
Route::post("/ReviewDetails", [ReviewController::class, 'getReviewDetails'])->middleware('LoginCheck');
Route::post("/ReviewUpdate", [ReviewController::class, 'reviewUpdate'])->middleware('LoginCheck');
Route::post("/ReviewAdd", [ReviewController::class, 'reviewAdd'])->middleware('LoginCheck');

// Admin Panel Review Management
Route::get('/Login', [LoginController::class, 'LoginIndex']);
Route::post('/onLogin', [LoginController::class, 'onLogin']);
Route::get('/Logout', [LoginController::class, 'onLogout']);

// Admin Panel Photo Gallery
Route::get('/photo', [PhotoController::class, 'PhotoIndex'])->middleware('LoginCheck');
Route::post('/PhotoUpload', [PhotoController::class, 'PhotoUpload'])->middleware('LoginCheck');
Route::get('/PhotoJSON', [PhotoController::class, 'PhotoJSON'])->middleware('LoginCheck');
Route::get('/PhotoJSONByID/{id}', [PhotoController::class, 'PhotoJSONByID'])->middleware('LoginCheck');
Route::post('/PhotoDelete', [PhotoController::class, 'PhotoDelete'])->middleware('LoginCheck');

// Admin Panel Profile
Route::get('/profile', [LoginRegistraitonCOntroller::class, 'LoginGithubIndex'])->middleware('LoginCheck');


Route::get('/callGithub',[LoginRegistraitonCOntroller::class, 'callGithub']);
Route::get('/GithubCallBack',[LoginRegistraitonCOntroller::class, 'GithubCallBack']);
Route::get('/logout', [LoginRegistraitonCOntroller::class, 'onLogout']);