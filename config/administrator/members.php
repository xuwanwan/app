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
            'title' => '邀请人(输入电话号码搜索)',
            'type' => 'relationship',
            'autocomplete' => true,
            'num_options' => 15,
            'name_field' => 'username',
        ],
        'adTags' => [
            'title' => '用户广告标签设置',
            'type' => 'relationship',
            'name_field'=> 'name',
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
