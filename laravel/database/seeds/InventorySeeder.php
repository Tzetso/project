<?php

use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventory')->insert([
      		[
        		'user_id' => 1,
        		'item_id' => 1,
      			'quantity' => 1,
     	    ],
        	[
        		'user_id' => 1,
        		'item_id' => 2,
        		'quantity' => 0,
        	],
        	[
        		'user_id' => 1,
        		'item_id' => 3,
        		'quantity' => 0,
        	],
        	[
        		'user_id' => 1,
        		'item_id' => 4,
        		'quantity' => 0,
        	],
        	[
        		'user_id' => 2,
        		'item_id' => 1,
        		'quantity' => 1,
        	],
        	[
        		'user_id' => 2,
        		'item_id' => 2,
        		'quantity' => 0,
       		],
       		[
        		'user_id' => 2,
        		'item_id' => 3,
       			'quantity' => 0,
       		],
        	[
        		'user_id' => 2,
        		'item_id' => 4,
        		'quantity' => 0,
        	],
       		[
        		'user_id' => 3,
        		'item_id' => 1,
       			'quantity' => 1,
       		],
       		[
        		'user_id' => 3,
        		'item_id' => 2,
       			'quantity' => 0,
        	],
       		[
        		'user_id' => 3,
        		'item_id' => 3,
       			'quantity' => 0,
        	],
        	[
        		'user_id' => 3,
        		'item_id' => 4,
        		'quantity' => 0,
        	],
        ]);
    }
}
