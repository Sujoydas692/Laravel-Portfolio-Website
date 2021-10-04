<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;
use App\Models\ProjectsModel;
use App\Models\ContactModel;
use App\Models\ReviewModel;

class HomeController extends Controller
{
    function homeIndex(){

        $UserIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate = date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address'=>$UserIP, 'visiting_time'=>$timeDate]);

        $ServiceData = json_decode(ServicesModel::all());
        $CourseData = json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
        $ProjectData = json_decode(ProjectsModel::orderBy('id','desc')->limit(6)->get());
        $ReviewData = json_decode(ReviewModel::all());



        return view('Home',[
            'ServiceData'=>$ServiceData,
            'CourseData'=>$CourseData,
            'ProjectData'=>$ProjectData,
            'ReviewData'=>$ReviewData
        ]);
    }

    function ContactSend(Request $request){

        $contact_name = $request->input('contact_name');
        $contact_phn = $request->input('contact_phn');
        $contact_email = $request->input('contact_email');
        $contact_msg = $request->input('contact_msg');

        $result = ContactModel::insert([
            'contact_name'=>$contact_name,
            'contact_phn'=>$contact_phn,
            'contact_email'=>$contact_email,
            'contact_msg'=>$contact_msg
        ]);

        if ($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
