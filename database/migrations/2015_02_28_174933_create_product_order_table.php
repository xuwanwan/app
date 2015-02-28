<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_order', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('order_id')->unique();
            $table->decimal('amount', 8, 2);
            $table->decimal('freight', 8, 2);
            $table->integer('member_id');
            $table->tinyInteger('status');
            $table->string('username');
            $table->string('phone');
            $table->string('district');
            $table->string('district_detail');

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
		Schema::drop('product_order');
	}

}
