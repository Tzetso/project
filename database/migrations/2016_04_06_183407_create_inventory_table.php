<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('inventory')){
        	
        	Schema::create('inventory', function (Blueprint $table) {
	            $table->integer('user_id')->unsigned();
	            $table->integer('item_id')->unsigned();
	            $table->integer('quantity')->default(0)->unsigned();
	
	            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
	            $table->primary(['user_id', 'item_id']);
	        });
        }        		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventory');
    }
}
