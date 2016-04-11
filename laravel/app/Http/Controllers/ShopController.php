<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Item;

use Auth;

class ShopController extends Controller
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
    
    private function getSkins($user)
    {
    	$skins = Item::where('cosmetic', '=', '1')->get();
    	$onsale = [];
    	foreach($skins as $skin){
    		if($user->items->contains($skin->id) == false){
    			$onsale[] = $skin;
    		}
    	}
    	
    	return $onsale;
    }

    /**
     * Show the shop.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();
    	$items = Item::where('cosmetic', '=', '0')->get();    	
		$skins = $this->getSkins($user);

    	$money = $user->currency;
    	
        return view('shop', compact('user', 'items', 'money', 'skins'));
    }
    
    public function buy()
    {	
    	$id = request()->input('button');
    	$user = Auth::user();    	
    	$price = Item::find($id)->price;
    	$money = $user->currency;		
    	
    	
    	if($money >= $price){
    		
    		if(Item::find($id)->cosmetic != 0){
    			if($user->items->contains($id) == false){
    				$user->items()->attach($id);
    			}  			
    		}else{
    			$inc = $user->items->find($id)->pivot->quantity + 1;
    			$user->items->find($id)->pivot->update(['quantity' => $inc]); 			
    		}   		
    		
    		$user->update(['currency' => $money - $price]);
    	}   	
    		
    	return back();
    }
}
