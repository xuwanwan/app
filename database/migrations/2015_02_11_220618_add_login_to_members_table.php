<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLoginToMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('members', function(Blueprint $table)
		{
			$table->boolean('login')->after('fans_related');
			$table->timestamp('last_attempt_at')->after('updated_at');
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
			$table->dropColumn('login');
			$table->dropColumn('last_attempt_at');
		});
	}

}
