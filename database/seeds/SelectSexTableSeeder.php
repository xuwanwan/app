<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SelectSexTableSeeder extends Seeder {

	public function run()
	{
        DB::table('select_sex')->truncate();

        $data = [
        	['description'=>'男'],
        	['description'=>'女'],
        ];

        DB::table('select_sex')->insert($data);
	}

}