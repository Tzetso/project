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

    public function getScore()
    {
    	$highscore = response()->json([
    	"highscore" => Auth::user()->highscore
    	]);

        return Auth::user()->highscore;
    }
    
    public function postScore()
    {
    	$user = Auth::user();
<<<<<<< HEAD
            	$score = request()->input('score');
            	$user->highscore = $score;
            	$user->save;
=======
    	if(request()->input('score')){
    		$user->highscore = request()->input('score');
    	}   	
    	
    	$user->currency += request()->input('coin');
    	$user->save;
>>>>>>> 873b3ce26cf2899a690d0db26e2981afd33516d6
    }
}
