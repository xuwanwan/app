<?php

return [

    'title' => '广告列表',
    'single' => '广告',
    'model' => 'Advertise',

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'company_name' => [
            'title' => '所属公司',
            'relationship' => 'company',
            'select' => '(:table).name',
        ],
        'introduce' => [
            'title' => '广告说明'
        ],
    ],

    'edit_fields' => [

        'logo' => [
            'title' => '主图',
            'type' => 'image',
            'location' => public_path() . '/uploads/products/originals/',
            'naming' => 'random',
            'length' => 20,
            'size_limit' => 20,
            'sizes' => array(
                array(65, 57, 'crop', public_path() . '/uploads/products/thumbs/small/', 100),
                array(220, 138, 'landscape', public_path() . '/uploads/products/thumbs/medium/', 100),
                array(383, 276, 'fit', public_path() . '/uploads/products/thumbs/full/', 100)
            )
        ],
        'introduce' => [
            'title' => '广告说明',
            'type' => 'textarea',
            'limit' => '500',
            'height' => '130',
        ],

        'company' => [
            'type' => 'relationship',
            'title' => '所属公司',
        ],
        'detail' => [
            'type' => 'wysiwyg',
            'title' => '图文详情',
        ]


    ],

    'filters' => [
    ],

    'permission' => function() {
#        return Sentry::hasAccess('product_tags');
        return true;
    },

    'form_width' => 500,
];
