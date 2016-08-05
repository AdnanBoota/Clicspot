<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNasAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('nas_attributes', function(Blueprint $table)
		{
			$table->foreign('nasid', 'nas_attributes_ibfk_1')->references('id')->on('nas')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('nas_attributes', function(Blueprint $table)
		{
			$table->dropForeign('nas_attributes_ibfk_1');
		});
	}

}
