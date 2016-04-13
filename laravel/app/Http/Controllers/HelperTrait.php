<?php

namespace App\Http\Controllers;

use App\User;
use App\Item;
use Auth;


trait HelperTrait{
	
	public function getUsers()
	{
		return User::orderBy($sortBy, $order);
	}
	/*
	 * Get the logged user
	 */
	public function getUser()
	{
		return Auth::user();
	}
	/*
	 * Get the logged users' highscore
	 */
	public function getHighscore()
	{
		return Auth::user()->highscore;
	}
	/*
	 * Get the users' currently selected skin
	 */
	public function getSkin()
	{
		$skins = getUser()->items->where('cosmetic', 1);
		
		foreach($skins as $skin){
			if($skin->pivot->quantity > 0){
				$avatar = $skin;
				break;
			}
		}
		
		return $avatar->picture;
	}
	/*
	 * Get all the consumable items
	 */
	public function getConsumables()
	{
		return Item::where('cosmetic', '=', '0');
	}
	/*
	 * Get the skins the user doesnt have
	 */
	public function getSkins()
	{
		
	}
	/*
	 * Get the amount of items a user has by name
	 */
	public function getItems($name)
	{
		$user = getUser();
		$id = getItemId($name);
		return $user->items->find($id)->pivot->quantity;
	}
	/*
	 * Get an item id
	 */
	public function getItemId($name)
	{
		return Item::where('name', $name)->first()->id;
	}
	/*
	 * Set a new highscore for the user
	 */
	public function setScore($value)
	{
		getUser()->highscore = $value;		
	}
	/*
	 * Add coins and substract items from the user
	 */
	public function addOther($coins, $shields, $revives)
	{
		$user = getUser();
		$user->currency += $coins;
		$user->items->find(getItemId('Shield'))->pivot->update([quantity => $shields]);
		$user->items->find(getItemId('Revive'))->pivot->update([quantity => $revives]);
		$user->save();
	}
	
}