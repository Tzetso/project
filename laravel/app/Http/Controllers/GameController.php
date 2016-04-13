<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

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
    	$highscore = Helper::getHighscore();
    	$avatar = Helper::getSkin();
    	$shields = Helper::getItems('Shield');
    	$revives = Helper::getItems('Revive');
    	 
    	$data = response()->json([
    		'highscore' => $highscore,
    		'player' => $avatar->picture,
    		'shields' => $shields,
    		'revives' => $revives
    	]);

        return $data;
    }
    
    public function postChanges()
    {
    	$user = Helper::getUser(); 
    	$shieldsId = Helper::getItemId('Shield');
    	$revivesId = Helper::getItemId('Revive');
    	if(request()->input('score')){
    		$user->highscore = request()->input('score');
    	}
		
    	Helper::addOther(request()->input('coin'),  request()->input('shield'), request()->input('revive'));
    	/* $user->currency += request()->input('coin');
    	
    	$user->items->find($shieldsId)->pivot->update(['quantity' => request()->input('shield')]);
    	$user->items->find($revivesId)->pivot->update(['quantity' => request()->input('revive')]);
    	$user->save(); */
    }
}
