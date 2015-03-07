<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('card_order', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('order_id');
            $table->decimal('amount', 16, 2);
            $table->integer('member_id');
            $table->integer('seller_id');
            $table->tinyInteger('status');
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
		Schema::drop('card_order');
	}

}
