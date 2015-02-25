<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CategoryTableSeeder extends Seeder {

	public function run()
	{
        \DB::table('categories')->truncate();
//        $roots = ['健康饮品', '肉禽蛋类', '果蔬制品', '有机粮油', '糖果糕点', '调味制品'];
        $types = \Config::get('config.category');
        $roots = array_values($types);
        foreach ($roots as $root)
        {
            Category::create(array(
                'name' => $root,
            ));
        }
	}

}