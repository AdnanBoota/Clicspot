<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStarsRatingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stars_rating', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('admin_id');
			$table->text('email_id', 65535);
			$table->integer('points');
			$table->smallInteger('stars')->default(2);
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
		Schema::drop('stars_rating');
	}

}
