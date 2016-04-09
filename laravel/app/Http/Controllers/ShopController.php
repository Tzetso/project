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
    	$items = Item::all();
    	
        return view('shop', compact('items'));
    }
    
    public function buy()
    {	
    	
    	$user = Auth::user();
    	$id = request()->input('button');
    	$inc = $user->items->find($id)->pivot->quantity + 1;
    	$user->items->find($id)->pivot->update(['quantity' => $inc]);
    	
    	return back();
    }
}
