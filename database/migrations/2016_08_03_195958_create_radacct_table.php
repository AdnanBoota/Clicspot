<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRadacctTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('radacct', function(Blueprint $table)
		{
			$table->bigInteger('radacctid', true);
			$table->string('acctsessionid', 64)->default('')->index('acctsessionid');
			$table->string('acctuniqueid', 32)->default('')->unique('acctuniqueid');
			$table->string('username', 64)->default('')->index('username');
			$table->string('groupname', 64)->default('');
			$table->string('realm', 64)->nullable()->default('');
			$table->string('nasipaddress', 15)->default('')->index('nasipaddress');
			$table->string('nasportid', 15)->nullable();
			$table->string('nasporttype', 32)->nullable();
			$table->dateTime('acctstarttime')->nullable()->index('acctstarttime');
			$table->dateTime('acctstoptime')->nullable()->index('acctstoptime');
			$table->integer('acctsessiontime')->unsigned()->nullable()->index('acctsessiontime');
			$table->string('acctauthentic', 32)->nullable();
			$table->string('connectinfo_start', 50)->nullable();
			$table->string('connectinfo_stop', 50)->nullable();
			$table->bigInteger('acctinputoctets')->nullable();
			$table->bigInteger('acctoutputoctets')->nullable();
			$table->string('calledstationid', 50)->default('')->index('nasid_calledstationid_idx');
			$table->string('callingstationid', 50)->default('');
			$table->string('acctterminatecause', 32)->default('');
			$table->string('servicetype', 32)->nullable();
			$table->string('framedprotocol', 32)->nullable();
			$table->string('framedipaddress', 15)->default('')->index('framedipaddress');
			$table->integer('acctstartdelay')->unsigned()->nullable();
			$table->integer('acctstopdelay')->unsigned()->nullable();
			$table->string('xascendsessionsvrkey', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('radacct');
	}

}
