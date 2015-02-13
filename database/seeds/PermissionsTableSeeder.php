<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PermissionsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('permissions')->truncate();

		$arr = [
			['name'=>'用户列表', 'en'=>'users'],
			['name'=>'用户组', 'en'=>'groups'],
			['name'=>'标签管理', 'en'=>'permissions'],
		];

		DB::table('permissions')->insert($arr);
	}

}