<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SelectPositionTableSeeder extends Seeder {

	public function run()
	{
        DB::table('select_position')->truncate();

        $data = [
        	['description'=>'普通职员'],
        	['description'=>'高级职员'],
        	['description'=>'中层管理'],
        	['description'=>'高层管理'],
        	['description'=>'其它'],
        ];

        DB::table('select_position')->insert($data);
	}

}