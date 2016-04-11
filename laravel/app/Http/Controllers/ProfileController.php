<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

class ProfileController extends Controller
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
     * Show the profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();
    	
    	$items = $user->items->where('cosmetic', 0);
    	
    	$skins = $user->items->where('cosmetic', 1);
    	
    	foreach($skins as $skin){
			if($skin->pivot->quantity > 0){  
				$avatar = $skin;
				break;
			}
    	}
    	
        return view('profile', compact('user', 'items', 'avatar'));
    }
    
    public function skins()
    {
    	$user = Auth::user();
    	
    	$skins = $user->items->where('cosmetic', 1);
    	 
    	foreach($skins as $skin){
    		if($skin->pivot->quantity > 0){
    			$avatar = $skin;
    			break;
    		}
    	}
    	 
    	return view('skins', compact('user', 'skins', 'avatar'));
    }
    
    public function changeSkin()
    {
    	$id = request()->input('skin');
    	$user = Auth::user();
    	$skins = $user->items->where('cosmetic', 1);
    	
    	foreach($skins as $skin){
    		if($skin->pivot->quantity > 0){
    			$avatar = $skin;
    			break;
    		}
    	}
    	
    	if($avatar->id != $id){
    		$user->items->find($avatar->id)->pivot->update(['quantity' => 0]);
    		$user->items->find($id)->pivot->update(['quantity' => 1]);
    	}
    	
    	return redirect('/profile');
    }
}
