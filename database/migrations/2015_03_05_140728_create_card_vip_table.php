<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardVipTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('card_vip', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('logo');
            $table->string('deadline');
            $table->integer('sales_volume');
            $table->text('privilege');
            $table->integer('seller_id');
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
		Schema::drop('card_vip');
	}

}
