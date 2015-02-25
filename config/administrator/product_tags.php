<?php

return [

    'title' => '产品标签列表',
    'single' => '标签',
    'model' => 'ProductTag',

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'description' => [
            'title' => '名称'
        ],
    ],

    'edit_fields' => [

        'description' => [
            'title' => '名称'
        ],
    ],

    'filters' => [
    ],

    'permission' => function() {
#        return Sentry::hasAccess('product_tags');
        return true;
    }

];
