<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampaignTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('adminid')->index('adminid');
			$table->string('name', 100);
			$table->string('backgroundimage');
			$table->string('logoimage');
			$table->string('fontcolor');
			$table->text('description');
			$table->enum('logoposition', array('left','center','right'))->default('left');
			$table->integer('backgroundzoom')->default(100);
			$table->enum('blurImg', array('0','1'));
			$table->enum('advertcheck', array('0','1'));
			$table->string('advertimage');
			$table->integer('delayPeriod');
			$table->string('fakebrowser');
			$table->string('fkNasId');
			$table->string('adverturl');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campaign');
	}

}
