<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User as User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		

        User::create(['name' => 'Mitul', 'password' => Hash::make( '123456' ) , 'email' => 'gadhia.mitul41@gmail.com']);
	}


}
