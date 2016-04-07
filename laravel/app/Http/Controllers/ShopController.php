<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Item;

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
    
}
