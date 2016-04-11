<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
        [
        		'name' => 'Phaser Dude',
        		'description' => 'This is your default skin.',
        		'price' => 0,
        		'picture' => 'assets/phaser-dude.png',
        		'cosmetic' => '1'
        ],
        [
        		'name' => 'Shield',
        		'description' => 'This defends against skulls.',
        		'price' => 500,
        		'picture' => 'assets/shield.png',
        		'cosmetic' => 0
        ],
        [
        		'name' => 'Revive',
        		'description' => 'This revives the player after death.',
        		'price' => 1000,
        		'picture' => 'assets/revive.png',
        		'cosmetic' => 0
        ],
        [
        		'name' => 'Clown',
        		'description' => 'Wanna know how I got these scars?',
        		'price' => 2000,
        		'picture' => 'assets/clown.png',
        		'cosmetic' => 1
        ],
        [
  	    		'name' => 'Lemming',
        		'description' => 'This is a premium cosmetic item.',
        		'price' => 5000,
        		'picture' => 'assets/lemming.png',
        		'cosmetic' => 1
        ],
        
        ]);
    }
}
