<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SelectTrafficTableSeeder extends Seeder {

	public function run()
	{
        DB::table('select_traffic')->truncate();

        $data = [
        	['description'=>'公交'],
        	['description'=>'电动车/自行车'],
        	['description'=>'摩托车'],
        	['description'=>'小汽车'],
        	['description'=>'单位班车'],
        ];

        DB::table('select_traffic')->insert($data);
	}

}