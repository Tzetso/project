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
        		'name' => 'Cheap Item',
        		'description' => 'This is a cheap item.',
        		'price' => 250,
        		'picture' => '',
        		'cosmetic' => 0
        ],
        [
        		'name' => 'Average Item',
        		'description' => 'This is an average item.',
        		'price' => 500,
        		'picture' => '',
        		'cosmetic' => 0
        ],
        [
        		'name' => 'Expensive Item',
        		'description' => 'This is an expensive item.',
        		'price' => 1000,
        		'picture' => '',
        		'cosmetic' => 0
        ],
        [
        		'name' => 'Cosmetic Item',
        		'description' => 'This is a cosmetic item.',
        		'price' => 2000,
        		'picture' => '',
        		'cosmetic' => 1
        ],
        [
  	    		'name' => 'Premium Cosmetic Item ',
        		'description' => 'This is a premium cosmetic item.',
        		'price' => 5000,
        		'picture' => '',
        		'cosmetic' => 1
        ]
        ]);
    }
}
