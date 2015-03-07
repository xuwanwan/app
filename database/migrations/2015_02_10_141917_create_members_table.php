<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('remember_token',100)->nullable();
			$table->string('username');
			$table->string('phone')->unique();
			$table->string('password');
			$table->string('photo')->nullable()->default(NULL);
			$table->integer('level')->unsigned()->default(0);
			$table->integer('score')->unsigned()->default(0);
			$table->decimal('income_yesterday',16, 3)->default(0.000);
			$table->decimal('income_total', 16, 3)->default(0.000);
			$table->decimal('balance', 16, 3)->default(0.000);
			$table->integer('newfans_yesterday')->unsigned()->default(0);
			$table->integer('fans_direct')->unsigned()->default(0);
			$table->integer('fans_related')->unsigned()->default(0);

			$table->timestamps();

			$table->engine = 'InnoDB';
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members');
	}

}
