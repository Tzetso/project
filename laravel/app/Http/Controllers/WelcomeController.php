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
		$sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'highscore';
		$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
		
		if (!in_array($sortBy, ['highscore', 'username', 'currency'])){
			$sortBy = 'highscore';
		}
		
		if($order != 'ASC' && $order != 'DESC'){
			$order = 'DESC';
		}
		
		$users = User::orderBy($sortBy, $order)->take(10)->get();
		$count = 1;
		
		if(Auth::user()){
			$user = Auth::user();			
		}else{
			$user = null;		
		}
		
		return view('welcome', compact('user', 'users', 'count', 'order', 'sortBy'));
	}    

}
