<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('username', 50)->nullable()->unique('username_UNIQUE');
			$table->integer('type')->default(1);
			$table->string('name', 100);
			$table->text('firstname', 65535);
			$table->text('lastname', 65535);
			$table->string('email', 100)->nullable();
			$table->enum('gender', array('male','female'))->nullable();
			$table->string('profileurl', 100)->nullable();
			$table->string('avatar');
			$table->string('birthday');
			$table->enum('language', array('en','fr','es','de','nl','it','pt'));
			$table->string('location', 100)->nullable();
			$table->enum('subscribe', array('1','0'))->nullable()->default('1');
			$table->integer('isemailconfirmed')->default(0);
			$table->timestamps();
			$table->string('adminid', 20);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
