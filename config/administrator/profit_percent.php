<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/3/2
 * Time: 下午1:52
 */


return [

    'title' => '分利点管理',
    'single' => '分利',
    'model' => 'ProfitPercent',

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'base' => [
            'title' => '基本%'
        ],
        'province' => [
            'title' => '省级代理%'
        ],
        'city' => [
            'title' => '市级代理%'
        ],
        'store' => [
            'title' => '门店%'
        ],
        'member' => [
            'title' => '用户%'
        ],
    ],

    'edit_fields' => [

        'base' => [
            'title' => '基本%',
            'type' =>'number',
        ],
        'province' => [
            'title' => '省级代理%',
            'type' =>'number',
        ],
        'city' => [
            'title' => '市级代理%',
            'type' =>'number',
        ],
        'store' => [
            'title' => '门店%',
            'type' =>'number',
        ],
        'member' => [
            'title' => '用户%',
            'type' =>'number',
            'editable'=>false,
        ],
    ],


    'permission' => function() {
#        return Sentry::hasAccess('product_tags');
        return true;
    },

    'action_permissions'=> array(
        'create' => function($model)
        {
#            return Auth::user()->has_role('developer');
            $count = ProfitPercent::count();
            return !$count;
        }
    ),
];
