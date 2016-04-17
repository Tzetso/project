<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper;

use Hash;

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
    	$user = Helper::getUser();
    	
    	$items = Helper::getConsumables();
    	
    	$avatar = Helper::getSkin();
    	
        return view('profile', compact('user', 'items', 'avatar'));
    }
    /*
     * Shows the changes password view
     */
    public function passView()
    {
    	$user = Helper::getUser();
    	
    	return view('pass', compact('user'));
    }
    /*
     * Shows the change skins view
     */
    public function skins()
    {    	
    	$user = Helper::getUser();
    	
    	$skins = Helper::getSkins();
    	 
    	$avatar = Helper::getSkin();
    	 
    	return view('skins', compact('user', 'skins', 'avatar'));
    }
    /*
     * Changes the users' skin if another one was selected
     */
    public function changeSkin()
    {
    	$id = request()->input('skin');
    	$user = Helper::getUser();
    	$avatar = Helper::getSkin();
    	
    	if($avatar->id != $id){
    		$user->items->find($avatar->id)->pivot->update(['quantity' => 0]);
    		$user->items->find($id)->pivot->update(['quantity' => 1]);
    	}
    	
    	return redirect('/profile');
    }
    /*
     * Changes the password if the old one is entered correctly
     * and the new one passes validation
     */
    public function changePass()
    {	
    	$user = Helper::getUser();
    	if(!Hash::check(request()->input('old_password'),$user->password)){
    		$wrong = true;
    		return view('pass', compact('wrong'));
    	}
    	
    	$this->validate(request(), [
    			'new_password' => 'required|min:6|confirmed',
    	]);
    	
    	$user->password = bcrypt(request()->input('new_password'));
    	$user->save();
    }    
}
