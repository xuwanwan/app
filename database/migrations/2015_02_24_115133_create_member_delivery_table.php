<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberDeliveryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_delivery', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('member_id');
            $table->string('username');
            $table->string('phone');
            $table->string('postalcode');
            $table->string('district');
            $table->text('detail');
            $table->tinyInteger('default');
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
		Schema::drop('member_delivery');
	}

}
