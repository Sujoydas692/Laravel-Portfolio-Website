<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;

class LoginController extends Controller
{
    function LoginIndex(){
        return view('Login');
    }

    function onLogout(Request $request){
        $request->session()->flush();
        return redirect('/Login');
    }


    function onLogin(Request $request){
        $user = $request->input('user');
        $pass = $request->input('pass');
        $CountValue = AdminModel::where('username','=',$user)->where('password','=',$pass)->count();

        if ($CountValue==1){

            $request->session()->put('user',$user);
            return 1;
        }
        else{
            return 0;
        }
    }
}
