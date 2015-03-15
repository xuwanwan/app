<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberBankCardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_bank_card', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('bank_id');
            $table->string('card_number');
            $table->integer('district');
            $table->string('district_detail');
            $table->integer('member_id');
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
		Schema::drop('member_bank_card');
	}

}
