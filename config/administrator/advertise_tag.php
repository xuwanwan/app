<?php

return [

    'title' => '广告标签列表',
    'single' => '标签',
    'model' => 'AdvertiseTag',

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '名称'
        ],
    ],

    'edit_fields' => [

        'name' => [
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
