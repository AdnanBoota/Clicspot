<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('nas', function(Blueprint $table)
		{
			$table->foreign('campaignid', 'id')->references('id')->on('campaign')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('nasidentifier', 'macaddress')->references('macaddress')->on('routers')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('adminid', 'nasid')->references('id')->on('admin_user')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('nas', function(Blueprint $table)
		{
			$table->dropForeign('id');
			$table->dropForeign('macaddress');
			$table->dropForeign('nasid');
		});
	}

}
