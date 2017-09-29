<?php

use Illuminate\Database\Seeder;
use App\Eloquent\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 DB::table('users')->insert([
    	 	'name' => 'tranvanmy',
    	 	'email' => 'admin@gmail.com',
    	 	'password' => bcrypt(1234567),
    	 	'age' => '12',
    	 	'sex' => '1',
    	 	'phone' => '0912344353',
    	 	'address' => 'Nam Dinh',
    	 	'permission' => '1',
    	 	'specialist_id' => '2'
        ]);
    }
}
