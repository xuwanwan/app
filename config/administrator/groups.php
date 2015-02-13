<?php

return [

    'title' => '用户组',
    'single' => '用户组',
    'model' => app('config')['cartalyst/sentry::groups.model'],

    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'name' => [
            'title' => '组名',
        ],
        'permissions' => [
            'title' => '拥有的权限',
            'output' => function ($value){
                $return = '';
                foreach ($value as $k=>$v) {
                    $k = DB::table('permissions')->where('en', $k)->pluck('name');
                    $return .= ($v==1)?$k.'√':'';
                }
                return $return;
            }
        ]
    ],

    'edit_fields' => [

        'name' => [
            'title' => '组名',
            'type' => 'text'
        ],
    ],

    'permission' => function() {
        return Sentry::hasAccess('groups');
    }

];
