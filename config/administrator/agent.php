<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/3/2
 * Time: 下午2:52
 */
return [

    'title' => '代理商列表',
    'single' => '代理商',
    #   'model' => app('config')['cartalyst/sentry::users.model'],
    'model' => 'Member',

    'columns' => [
        'id' => [
            'title' => 'ID'
        ],
        'username' => [
            'title' => '名称',
        ],
        'phone' => [
            'title' => '手机号码',
        ],
        'type' => [
            'title' => '代理商类型',
        ],
        'district_path' => [
            'title' => '区域',
        ],

    ],

    'edit_fields' => [

        'username' => [
            'title' => '名称',
            'type' => 'text',
        ],
        'phone' => [
            'title' => '电话',
        ],
        'type' => [
            'title' => '代理商类型',
            'type' => 'enum',
            'options' => [
                '1' => '省级代理',
                '2' => '市级代理',
                '3' => '门店代理',
                '4' => '公司',
            ]
        ],
        'districts' => [
            'title' => '区域',
            'type' => 'relationship',
            'autocomplete' => true,
            'num_options' => 15,
#            'name_field' => 'name',
            'search_fields' => array("CONCAT(name, ' ', initials, ' ', pinyin)"),
        ],
        'password' => [
            'title' => '密码',
            'type' => 'password',
        ],

    ],
    'rules' => [
        'username' => 'required',
        'phone' => 'required|digits:11',
        'type' => 'required',
        'district' => 'required',
#        'password' => 'required',

    ],

    'filters' => [
        'id' => [
            'title' => 'User ID',
        ],
        'username' => [
            'title' => '代理商名称',
        ],
        'phone' => [
            'title' => '手机号码',
        ],
    ],

    'query_filter' => function($query) {
        $query->where('type', '>', 0);
    },

    'permission' => function() {
#        return Sentry::hasAccess('users');
        return true;
    }

];
