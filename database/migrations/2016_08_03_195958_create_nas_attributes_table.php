<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNasAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nas_attributes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('nasid')->index('nasid');
			$table->integer('type')->default(1);
			$table->string('attribute', 64);
			$table->string('op', 2)->default(':=');
			$table->string('value', 253);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nas_attributes');
	}

}
