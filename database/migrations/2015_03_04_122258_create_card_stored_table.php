<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardStoredTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('card_stored', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('logo');
            $table->decimal('price', 16,2);
            $table->decimal('origin_price', 16,2);
            $table->integer('sales_volume');
            $table->text('introduce');
            $table->text('instruction');
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
		Schema::drop('card_stored');
	}

}
