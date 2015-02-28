<?php

return [

    'title' => '订单列表',
    'single' => '订单',
    'model' => 'ProductOrder',

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'order_id' => [
            'title' => '订单号'
        ],
        'amount' => [
            'title' => '金额',
        ],
        'username' => [
            'title' => '收货人',
        ],
        'phone' => [
            'title' => '收货电话',
        ],
        'order_status' => [
            'title' => '订单状态',
        ],

        'created_at' => [
            'title' => '创建时间',
        ],
    ],

    'edit_fields' => [
        'district_detail' => [
            'title' => '收货地址'
        ],
    ],

    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'order_id' => [
            'title' => '订单号',
        ],
    ],

    'actions' => [
        'status_3' => [
            'title' => '已发货',
            'messages' => array(
                'active' => 'Reordering...',
                'success' => 'Reordered',
                'error' => 'There was an error while reordering',
            ),
            //the model is passed to the closure
            'action' => function($model)
            {
                return $model->update(['status'=>3]);
            }
        ]
    ],
    'action_permissions'=> array(
        'create' => function($model)
        {
            return false;
        }
    ),
    'permission' => function() {
#        return Sentry::hasAccess('products');
        return true;
    },


];
