<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('friends_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('friend_id')->unsigned()->index();
			$table->integer('member_id')->unsigned()->index();
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
		Schema::drop('friends_users');
	}

}
