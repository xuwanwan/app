<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SelectHouseTableSeeder extends Seeder {

	public function run()
	{
        DB::table('select_house')->truncate();

        $data = [
        	['description'=>'自购房'],
        	['description'=>'单位宿舍'],
        	['description'=>'租房'],
        	['description'=>'租房'],
        	['description'=>'借住'],
        ];

        DB::table('select_house')->insert($data);

	}

}