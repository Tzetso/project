<?php

namespace App\Http\Controllers;

use App\User;
use App\Item;
use Auth;


class Helper{
	/*
	 * Get the logged user
	 */
	public static function getUser()
	{
		return Auth::user();
	}
	/*
	 * Get the logged users' highscore
	 */
	public static function getHighscore()
	{
		return Auth::user()->highscore;
	}
	/*
	 * Get the users' currently selected skin
	 */
	public static function getSkin()
	{
		$skins = self::getUser()->items->where('cosmetic', 1);
		
		foreach($skins as $skin){
			if($skin->pivot->quantity > 0){
				$avatar = $skin;
				break;
			}
		}
		
		return $avatar;
	}
	/*
	 * Get all the skins the user has
	 */
	public static function getSkins()
	{
		$user = self::getUser();
		$skins = $user->items()->where('cosmetic', '=', '1')->orderBy('name', 'ASC')->get();
		return $skins;
	}
	/*
	 * Get the skins the user doesnt have
	 */
	public static function getSkinsShop()
	{
		$user = self::getUser();
		$skins = self::getCosmetic();
		$onSale = [];
		foreach($skins as $skin){
			if($user->items->contains($skin->id) == false){
				$onSale[] = $skin;
			}
		}
			
		return $onSale;
	}
	/*
	 * Get all the consumable items
	 */
	public static function getConsumables()
	{
		return Item::where('cosmetic', '=', '0')->orderBy('price', 'ASC')->get();
	}
	/*
	 * Get the all the cosmetic items
	 */
	public static function getCosmetic()
	{
		return Item::where('cosmetic', '=', '1')->orderBy('price', 'ASC')->get();	
	}
	/*
	 * Get an item id
	 */
	public static function getItemId($name)
	{
		return Item::where('name', $name)->first()->id;
	}
	/*
	 * Get the amount of items a user has by name
	 */
	public static function getItems($name)
	{
		$user = self::getUser();
		$id = self::getItemId($name);
		return $user->items->find($id)->pivot->quantity;
	}
	/*
	 * Set a new highscore for the user
	 */
	public static function setScore($value)
	{
		self::getUser()->highscore = $value;		
	}
	/*
	 * Add coins and substract items from the user
	 */
	public static function addOther($coins, $shields, $revives)
	{
		$user = self::getUser();
		$user->currency += $coins;
		$user->items->find(self::getItemId('Shield'))->pivot->update(['quantity' => $shields]);
		$user->items->find(self::getItemId('Revive'))->pivot->update(['quantity' => $revives]);
		$user->save();
	}
	/*
	 * Order the users
	 */
	public static function orderUsers($sortBy, $order)
	{
		return User::orderBy($sortBy, $order);
	}
}