<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BankInfoTableSeeder extends Seeder {

	public function run()
	{
        DB::table('bank_info')->truncate();

        $data = [
        	['name'=>'工商银行'],
            ['name'=>'建设银行'],
        ];

        DB::table('bank_info')->insert($data);

	}

}