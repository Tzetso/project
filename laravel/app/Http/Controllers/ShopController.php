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

    /**
     * Show the shop.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();
    	$items = Item::all();
    	$money = $user->currency;
    	
        return view('shop', compact('items', 'money'));
    }
    
    public function buy()
    {	
    	$id = request()->input('button');
    	$user = Auth::user();    	
    	$price = Item::find($id)->price;
    	$money = $user->currency;		
    	$inc = $user->items->find($id)->pivot->quantity + 1;
    	
    	if($money >= $price){
    		$user->items->find($id)->pivot->update(['quantity' => $inc]);
    		$user->update(['currency' => $money - $price]);
    	}   	
    		
    	return back();
    }
}
