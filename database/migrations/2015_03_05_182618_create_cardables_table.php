<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cardables', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('card_order_id');
            $table->integer('num');
            $table->integer('cardable_id');
            $table->string('cardable_type');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cardables');
	}

}
