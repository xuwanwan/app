<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Weile\Member;

class MembersTableSeeder extends Seeder {

	public function run()
	{
		// $faker = Faker::create('zh_CN');

		// foreach(range(1, 1) as $index)
		// {
		// 	Member::create([
		// 		'username'=>'bbszt',
		// 		'email'=>'119@xx.com',
		// 		'phone'=>'18002590105',
		// 		'password'=>Hash::make('111'),

		// 	]);
		// }
		DB::table('members')->truncate();
		
		Member::create([
			'username'=>'bbszt',
			'phone'=>'18002590105',
			'password'=>'111',
		]);		
		Member::create([
			'username'=>'bbszt',
			'phone'=>'11@qq.com',
			'password'=>'111',
		]);		
	}

}