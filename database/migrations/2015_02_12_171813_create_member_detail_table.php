<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_detail', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('sign');
			$table->tinyInteger('sex');
			$table->timestamp('birthday');
			$table->integer('height');
			$table->integer('weight');
			$table->integer('now_district');
			$table->integer('birth_district');	
			$table->integer('education');	
			$table->integer('profession');	
			$table->integer('monthly_income');	
			$table->integer('position');	
			$table->integer('house');	
			$table->integer('traffic');	
			$table->integer('marriage_status');	


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
		Schema::drop('member_detail');
	}

}
