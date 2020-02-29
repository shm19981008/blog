<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login;

class LoginController extends Controller
{
    public function login(){
    	return view('login.login');
    }
    public function logindo(Request $request){
    	$data=$request->except('_token');
    	$data['upwd']=md5($data['upwd']);
    	$user=Login::where($data)->first();
    	if($user){
    		session(['user'=>$user]);
    		$request->session()->save();
    		return redirect('/paper/list');
    	}
    	return redirect('/login')->with('msg','没有此用户');
    }
}
