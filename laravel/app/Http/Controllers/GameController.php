<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class GameController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('game');
    }

    public function getData()
    {
    	$data = response()->json([
    		"highscore" => Auth::user()->highscore
    	]);

        return $data;
    }
    
    public function postChanges()
    {
    	$user = Auth::user(); 
    	if(request()->input('score')){
    		$user->highscore = request()->input('score');
    	}
		
    	$user->currency += request()->input('coin');
    	$user->save;
    }
}
