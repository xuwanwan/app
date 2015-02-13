<?php

return [

    'title' => '权限标签管理',
    'single' => '标签',
    'model' => 'Permissions',

    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'name' => [
            'title' => '标签名',
        ],
        'en' => [
            'title' => 'en',
        ]
    ],

    'edit_fields' => [

        'name' => [
            'title' => '权限名',
            'type' => 'text'
        ],
         'en' => [
            'title' => 'en',
            'type'  => 'text',
            'setter' => false,
        ]       
    ],

    'permission' => function() {
        return Sentry::hasAccess('permissions');
    }
];
