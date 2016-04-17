<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'description', 'price', 'picture', 'cosmetic'
	];
	
	/*
	 * The users an item belongs to
	 */
	public function users()
	{
		return $this->belongsToMany('App\User', 'inventory', 'item_id', 'user_id')->withPivot('quantity');
	}
}
