<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SelectProfessionTableSeeder extends Seeder {

	public function run()
	{
        DB::table('select_profession')->truncate();

        $data = [
        	['description'=>'计算机/互联网/通信'],
        	['description'=>'生产/工艺/制造'],
        	['description'=>'商业/服务业/个体经营'],
        	['description'=>'金融/银行/投资/保险'],
        	['description'=>'文化/广告/传媒'],
        	['description'=>'学生'],
        ];

        DB::table('select_profession')->insert($data);
	}

}