<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderedTreeDistrictTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordered_tree_district', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();

            $table->string('name', 255);
            $table->string('initial');
            $table->string('initials');
            $table->string('pinyin');
            $table->string('suffix');
            $table->string('code');
            $table->string('area_code');
            $table->integer('order');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ordered_tree_district');
	}

}
