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
        		'picture' => ''
        ],
        [
        		'name' => 'Average Item',
        		'description' => 'This is an average item.',
        		'price' => 500,
        		'picture' => ''
        ],
        [
        		'name' => 'Expensive Item',
        		'description' => 'This is an expensive item.',
        		'price' => 1000,
        		'picture' => ''
        ]  		
        ]);
    }
}
