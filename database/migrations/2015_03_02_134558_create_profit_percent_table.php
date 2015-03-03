<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfitPercentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profit_percent', function(Blueprint $table)
		{
			$table->increments('id');
            $table->tinyInteger('base');
            $table->tinyInteger('province');
            $table->tinyInteger('city');
            $table->tinyInteger('store');
            $table->tinyInteger('member');
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
		Schema::drop('profit_percent');
	}

}
