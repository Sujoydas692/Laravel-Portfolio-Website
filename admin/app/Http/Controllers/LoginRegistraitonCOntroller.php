<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LoginRegistraitonCOntroller extends Controller
{

    function LoginGithubIndex(){
        return view('Profile');
    }

    function onLogout(Request $request){
        $request->session()->flush();
        return redirect('/Login');
    }

    function callGithub(){
       $callGithubLoginService = Socialite::driver('github')->redirect();
       return $callGithubLoginService;
    }

    function GithubCallBack(){
        $user = Socialite::driver('github')->stateless()->user();
        $token = $user->token;
        $userID = $user->getId();
        $userNickname = $user->getNickname();
        $userName = $user->getName();
        $userEmail = $user->getEmail();
        $userAvatar = $user->getAvatar();

        Session::put('token',$token);
        Session::put('userId',$userID);
        Session::put('nickName',$userNickname);
        Session::put('name',$userName);
        Session::put('email',$userEmail);
        Session::put('avatar',$userAvatar);

        $CountValue = DB::table('users')->where('email',$userEmail)->count();

        if ($CountValue==0){
            DB::table('users')->insert([
                'name'=>$userName,
                'email'=>$userEmail,
                'user_id'=>$userID,
                'nick_name'=>$userNickname,


            ]);
            return redirect('/');
        }
        else{
            return redirect('/');
        }


    }
}
