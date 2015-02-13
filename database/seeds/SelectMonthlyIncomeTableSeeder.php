<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SelectMonthlyIncomeTableSeeder extends Seeder {

	public function run()
	{
        DB::table('select_monthly_income')->truncate();

        $data = [
        	['description'=>'2000以下'],
        	['description'=>'2000-3500元'],
        	['description'=>'3501-5000元'],
        	['description'=>'5001-8000元'],
        	['description'=>'8001-12000元'],
        	['description'=>'12000以上'],
        ];

        DB::table('select_monthly_income')->insert($data);
	}

}