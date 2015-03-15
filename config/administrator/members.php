<?php

return [

    'title' => '会员列表',
    'single' => '会员',
 #   'model' => app('config')['cartalyst/sentry::users.model'],
    'model' => 'Member',

    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'username' => [
            'title' => '会员名称',
        ],
        'phone' => [
            'title' => '手机号码',
        ],
    ],

    'edit_fields' => [

        'username' => [
            'title' => '会员名称',
        ],

        'password' => [
            'title' => 'Password',
            'type' => 'password',
        ],

        'friends' => [
            'title' => '邀请人',
            'type' => 'relationship',
            'name_field' => 'username',
        ]

    ],

    'filters' => [
        'id' => [
            'title' => 'User ID',
        ],
         'username' => [
            'title' => '会员名称',
        ],
        'phone' => [
            'title' => '手机号码',
        ],
    ],

    'query_filter' => function($query) {
        $query->where('type', '=', 0);
    },
    'permission' => function() {
        return Sentry::hasAccess('users');
    }

];
