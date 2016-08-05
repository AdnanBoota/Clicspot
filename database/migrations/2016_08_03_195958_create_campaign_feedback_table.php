<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampaignFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_feedback', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('email_campaign_id');
			$table->text('message_id', 65535);
			$table->text('emailid', 65535);
			$table->text('email_name', 65535);
			$table->text('feedback_confirm', 65535);
			$table->text('rate', 65535);
			$table->smallInteger('points')->default(0);
			$table->integer('status');
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
		Schema::drop('campaign_feedback');
	}

}
