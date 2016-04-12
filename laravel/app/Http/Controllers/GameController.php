<?php

namespace App\Http\Controllers;

//use App\Http\Requests;
//use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use App\Item;

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
    	$user = Auth::user()->with('items')->first();
    	$skins = $user->items->where('cosmetic', 1);
    	$shieldsId = Item::where('name', 'Shield')->first()->id;
    	$shields = $user->items->find($shieldsId)->pivot->quantity;
    	$revivesId = Item::where('name', 'Revive')->first()->id;
    	$revives = $user->items->find($revivesId)->pivot->quantity;
    	 
    	foreach($skins as $skin){
    		if($skin->pivot->quantity > 0){
    			$avatar = $skin;
    			break;
    		}
    	}
    	
    	$data = response()->json([
    		'highscore' => Auth::user()->highscore,
    		'player' => $avatar->picture,
    		'shields' => $shields,
    		'revives' => $revives
    	]);

        return $data;
    }
    
    public function postChanges()
    {
    	$user = Auth::user(); 
    	$shieldsId = Item::where('name', 'Shield')->first()->id;
    	$revivesId = Item::where('name', 'Revive')->first()->id;
    	if(request()->input('score')){
    		$user->highscore = request()->input('score');
    	}
		
    	$user->currency += request()->input('coin');
    	$user->items->find($shieldsId)->pivot->quantity += request()->input('shield');
    	$user->items->find($revivessId)->pivot->quantity += request()->input('revive');
    	$user->save();
    }
}
