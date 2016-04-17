<?php

namespace App\Http\Controllers;

use App\Item;

use App\Http\Controllers\Helper;

class ShopController extends Controller
{
	/*
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the shop.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Helper::getUser();
    	$items = Helper::getConsumables();    	
		$skins = Helper::getSkinsShop();

    	$money = $user->currency;
    	
        return view('shop', compact('user', 'items', 'money', 'skins'));
    }
    
    public function buy()
    {	
    	$id = request()->input('button');
    	$user = Helper::getUser();   	
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
