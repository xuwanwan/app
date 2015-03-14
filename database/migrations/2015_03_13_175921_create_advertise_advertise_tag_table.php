<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertiseAdvertiseTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertise_advertise_tag', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('advertise_id')->unsigned()->index();
			$table->integer('advertise_tag_id')->unsigned()->index();
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
		Schema::drop('advertise_advertise_tag');
	}

}
