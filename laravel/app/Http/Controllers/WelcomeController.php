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
		
		switch($sortBy){
			case 'username':
				if($order == 'ASC'){
					$uOrder = 'DESC';
				}else{
					$uOrder = 'ASC';
				}
				$mOrder = 'DESC';
				$sOrder = 'DESC';
				
				break;
			case 'highscore':
				if($order == 'ASC'){
					$sOrder = 'DESC';
				}else{
					$sOrder = 'ASC';
				}
				$mOrder = 'DESC';
				$uOrder = 'ASC';
				
				break;
			case 'currency':
				if($order == 'ASC'){
					$mOrder = 'DESC';
				}else{
					$mOrder = 'ASC';
				}
				$uOrder = 'ASC';
				$sOrder = 'DESC';
				
				break;
		}
		
		return view('welcome', compact('user', 'users', 'count', 'uOrder', 'sOrder', 'mOrder'));
	}      	
}
