<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_feedback', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('username')->index('username');
			$table->string('nasidentifier')->index('nasidentifier');
			$table->string('message_id');
			$table->string('feedback_code');
			$table->enum('feedback_confirm', array('0','1'))->default('0');
			$table->enum('review', array('1','2','3'))->default('1');
			$table->enum('status', array('0','1'))->default('0');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_feedback');
	}

}
