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
		
		if (!in_array($sortBy, ['highscore', 'currency'])){
			$sortBy = 'highscore';
		}
		
		if($order != 'ASC' && $order != 'DESC'){
			$order = 'DESC';
		}
		
		$users = User::orderBy($sortBy, $order)->take(10)->get();
		$count = 1;
		
		return view('welcome', compact('users', 'count', 'order', 'sortBy'));
	}    

}
