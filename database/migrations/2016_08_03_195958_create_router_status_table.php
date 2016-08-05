<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouterStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('router_status', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('macaddress', 50)->index('router_status_mac_idx');
			$table->string('publicip', 50);
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
		Schema::drop('router_status');
	}

}
