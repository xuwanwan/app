<?php

return [

    'title' => '用户列表',
    'single' => '用户',
 #   'model' => app('config')['cartalyst/sentry::users.model'],
    'model' => 'User',

    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'email' => [
            'title' => 'Email',
        ],
        'created_at' => [
            'title' => '创建时间',
        ],
        'groups' => [
            'title' => '用户组',
            'relationship' => 'groups',
            'select' => 'GROUP_CONCAT((:table).name)',

        ]
    ],

    'edit_fields' => [

        'email' => [
            'title' => 'Email',
            'type' => 'text'
        ],

        'password' => [
            'title' => 'Password',
            'type' => 'password',
        ],
         'groups' => [
            'title' => '用户组',
            'type' => 'relationship',
        ]       
    ],

    'filters' => [
        'id' => [
            'title' => 'User ID',
        ],
        'email' => [
            'title' => 'Email',
        ],
    ],

    'permission' => function() {
        return Sentry::hasAccess('users');
    }

];
