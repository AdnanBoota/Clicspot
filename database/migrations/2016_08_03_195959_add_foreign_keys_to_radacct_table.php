<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRadacctTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('radacct', function(Blueprint $table)
		{
			$table->foreign('calledstationid', 'nasid_calledstationid')->references('nasidentifier')->on('nas')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('username', 'users_username')->references('username')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('radacct', function(Blueprint $table)
		{
			$table->dropForeign('nasid_calledstationid');
			$table->dropForeign('users_username');
		});
	}

}
