<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRouterStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('router_status', function(Blueprint $table)
		{
			$table->foreign('macaddress', 'router_status_mac')->references('macaddress')->on('routers')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('router_status', function(Blueprint $table)
		{
			$table->dropForeign('router_status_mac');
		});
	}

}
