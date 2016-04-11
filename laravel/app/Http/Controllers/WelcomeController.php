<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Auth;
class WelcomeController extends Controller
{
	public function index()
	{
		$users = User::orderBy('highscore', 'DESC')->take(10)->get();
		$count = 0;
		if(Auth::user()){
			$user = Auth::user();			
		}else{
			$user = null;		
		}
		
		return view('welcome', compact('user', 'users', 'count'));
	}
       	
}
