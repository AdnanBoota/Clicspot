<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailCampaignTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_campaign', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('transmission_id');
			$table->integer('adminid');
			$table->integer('emailListId');
			$table->integer('templateId');
			$table->string('campaignName');
			$table->string('campaignStatus');
			$table->string('senderEmail');
			$table->string('fromName');
			$table->string('subjectEmail');
			$table->string('selectList');
			$table->string('gender');
			$table->string('age');
			$table->string('checkbox');
			$table->text('formObject');
			$table->text('checkboxname', 65535);
			$table->string('router');
			$table->string('datequickselection');
			$table->string('recipientNoOfVisit');
			$table->string('currentForm');
			$table->string('duringRecipientLastVisit');
			$table->string('templatePreview');
			$table->string('noOfDays');
			$table->string('testEmailAddress');
			$table->dateTime('scheduleTime');
			$table->timestamp('createdDate')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_campaign');
	}

}
