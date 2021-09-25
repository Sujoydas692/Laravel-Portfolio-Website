<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;

class HomeController extends Controller
{
    function homeIndex(){

        $UserIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate = date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address'=>$UserIP, 'visiting_time'=>$timeDate]);

        $ServiceData = json_decode(ServicesModel::all());



        return view('Home');
    }
}
