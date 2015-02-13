<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SelectMarriageStatusTableSeeder extends Seeder {

	public function run()
	{
        DB::table('select_marriage_status')->truncate();

        $data = [
        	['description'=>'单身'],
        	['description'=>'恋爱中'],
        	['description'=>'已婚'],
        ];

        DB::table('select_marriage_status')->insert($data);
	}

}