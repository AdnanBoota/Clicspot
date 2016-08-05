<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoutersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('model')->index('router_model_idx');
			$table->string('macaddress', 50)->unique('macaddress_UNIQUE');
			$table->string('ssid', 50)->default('Clicspot');
			$table->integer('configversion')->nullable();
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
		Schema::drop('routers');
	}

}
