<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;

class CoursesController extends Controller
{
    function CoursePage(){
        $CourseData = json_decode(CourseModel::orderBy('id','desc')->get());
        return view('Course',['CourseData'=>$CourseData]);
    }
}
