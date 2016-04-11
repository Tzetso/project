<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
class WelcomeController extends Controller
{
	public function index()
	{
		$users = User::orderBy('highscore', 'DESC')->take(10)->get();
		$count = 0;
		return view('welcome', compact('users', 'count'));
	}
       	
}
