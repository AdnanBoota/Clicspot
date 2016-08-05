<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriptionHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription_history', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('adminid');
			$table->string('resourceid');
			$table->string('billid');
			$table->integer('amount');
			$table->date('nextpaymentdate');
			$table->string('description');
			$table->string('paymentstatus');
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
		Schema::drop('subscription_history');
	}

}
