<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTypeToMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('members', function(Blueprint $table)
		{
            $table->tinyInteger('type')->after('login');
            $table->integer('district')->after('type');
            $table->string('geo_hash')->after('district');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('members', function(Blueprint $table)
		{
			$table->dropColumn(['type','district', 'geo_hash']);
		});
	}

}
