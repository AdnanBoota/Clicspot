<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('adminid')->index('nasid_idx');
			$table->string('ssid')->default('Clicspot');
			$table->string('shortname', 32)->nullable();
			$table->string('nasidentifier', 45)->index('macaddress_idx');
			$table->integer('campaignid')->default(1)->index('campaign_idx');
			$table->string('secret', 60)->default('clicspot@wifi');
			$table->string('address');
			$table->string('redirectUrl');
			$table->string('tripAdvisorId');
			$table->string('latitude');
			$table->string('longitude');
			$table->enum('reviewstatus', array('0','1'))->default('0');
			$table->bigInteger('reviewEmailDelay')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nas');
	}

}
