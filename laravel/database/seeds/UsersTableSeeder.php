<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the users seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
        		'username' => 'User',
        		'email' => 'mail@site.com',
        		'password' => bcrypt('password'),
        		'currency' => 3000
        ],
        [
        		'username' => 'Potrebitel',
        		'email' => 'mail@site.bg',
        		'password' => bcrypt('parola'),
        		'currency' => 5000
        ],
        [
        		'username' => 'Peala',
        		'email' => 'peala@mail.com',
        		'password' => bcrypt('v171717p'),
        		'currency' => 10000
        ]  		
        ]);
    }
}
