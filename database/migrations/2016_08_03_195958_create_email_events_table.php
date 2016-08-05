<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_events', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('adminid');
			$table->integer('router_id')->nullable();
			$table->bigInteger('transmission_id');
			$table->enum('transmission_type', array('campaign','transactional','',''));
			$table->text('emailid', 65535);
			$table->text('feedback_confirm', 65535);
			$table->smallInteger('points')->default(0);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('update_at')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_events');
	}

}
