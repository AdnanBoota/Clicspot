<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailTemplateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_template', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('adminid');
			$table->string('templateName');
			$table->string('description');
			$table->string('firstname');
			$table->timestamp('createdDate')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_template');
	}

}
