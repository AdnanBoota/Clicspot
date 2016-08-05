<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCampaignAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('campaign_attributes', function(Blueprint $table)
		{
			$table->foreign('campaignid', 'campaignid')->references('id')->on('campaign')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('campaign_attributes', function(Blueprint $table)
		{
			$table->dropForeign('campaignid');
		});
	}

}
