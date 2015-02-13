<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SelectEducationTableSeeder extends Seeder {

	public function run()
	{
        DB::table('select_education')->truncate();

        $data = [
        	['description'=>'高中/专科及以下'],
        	['description'=>'大专'],
        	['description'=>'本科'],
        	['description'=>'硕士'],
        	['description'=>'博士及以上'],
        ];

        DB::table('select_education')->insert($data);

	}

}