<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_list', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('adminid')->index('adminid');
			$table->string('listname')->unique('listname');
			$table->string('favoredconnection');
			$table->string('visitors');
			$table->string('age');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('numberofvisit');
			$table->enum('isdatequickselection', array('0','1'))->default('0');
			$table->integer('datequickselection');
			$table->date('datefrom');
			$table->date('dateto');
			$table->string('router');
			$table->integer('rate');
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
		Schema::drop('email_list');
	}

}
