<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampaignAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_attributes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('campaignid')->index('campaignid_idx');
			$table->string('attribute', 64)->default('');
			$table->char('op', 2)->default(':=');
			$table->string('value', 253)->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campaign_attributes');
	}

}
