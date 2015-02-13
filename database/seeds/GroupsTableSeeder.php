<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class GroupsTableSeeder extends Seeder {

	public function run() {
        DB::table('groups')->truncate();

        // editors
        $permissions = array('permissions' => 1);
        $group = array('name' => 'Permissions', 'permissions' => $permissions);
        Sentry::createGroup($group);

        // bloggers
        $permissions = array('groups' => 1);
        $group = array('name' => 'Groups', 'permissions' => $permissions);
        Sentry::createGroup($group);

        // moderators
        $permissions = array('users' => 1);
        $group = array('name' => 'Users', 'permissions' => $permissions);
        Sentry::createGroup($group);

        // admins
        $permissions = array('users' => 1, 'groups' => 1, 'permissions' => 1);
        $group = array('name' => 'Admins', 'permissions' => $permissions);
        Sentry::createGroup($group);

	}
}