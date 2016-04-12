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
		if(empty($_GET)){
			$sortBy = 'highscore';
			$order = 'DESC';
		}else{
			$sortBy = $_GET['sortBy'];
			$order = $_GET['order'];
		}
		
		$users = User::orderBy($sortBy, $order)->paginate(3);
		$count = (($users->currentPage() - 1) * $users->perPage()) + 1;
		if(Auth::user()){
			$user = Auth::user();			
		}else{
			$user = null;		
		}
		
		if($order == 'DESC'){
			$order = 'ASC';
		}else{
			$order = 'DESC';
		}
		return view('welcome', compact('user', 'users', 'count', 'order'));
	}      	
}
