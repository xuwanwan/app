<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_reviews', function(Blueprint $table)
		{
			
                $table->increments('id');
                $table->integer('product_id');
                $table->integer('member_id');
                $table->integer('rating');
                $table->string('author');
                $table->string('title');
                $table->string('text');
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
		Schema::table('product_reviews', function(Blueprint $table)
		{
			//
		});
	}

}
