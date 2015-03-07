<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberCardCouponTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_card_coupon', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('card_id');
            $table->integer('member_id');
            $table->tinyInteger('status');
            $table->string('password');
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
		Schema::drop('member_card_coupon');
	}

}
