<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    function visitorIndex(){
        return view('Visitor');
    }

    function getVisitorData(){
        $result = json_encode(VisitorModel::all());

        return $result;
    }
}
