<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('username', 100);
			$table->string('password', 100);
			$table->enum('type', array('superadmin','vendor'))->default('vendor');
			$table->string('email', 100);
			$table->string('businessname', 100);
			$table->text('address', 65535);
			$table->string('city', 100);
			$table->integer('zip');
			$table->string('country', 100);
			$table->string('phone', 100);
			$table->string('siren');
			$table->string('nvat');
			$table->string('resourceid');
			$table->string('confirmationcode');
			$table->boolean('isemailconfirmed')->default(0);
			$table->boolean('isactivated')->default(1);
			$table->string('remember_token');
			$table->string('session_token');
			$table->string('redirect_flow_id');
			$table->timestamps();
			$table->text('userslinks', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_user');
	}

}
