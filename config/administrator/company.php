<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/24
 * Time: 下午9:08
 */
return array(

    /**
     * Model title
     *
     * @type string
     */
    'title' => '商家列表',

    /**
     * The singular name of your model
     *
     * @type string
     */
    'single' => '商家',

    /**
     * The class name of the Eloquent model that this config represents
     *
     * @type string
     */
    'model' => 'Company',

    /**
     * The columns array
     *
     * @type array
     */
    'columns' => array(
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'=>'商家名称'
        ],
        'phone' => [
            'title'=>'商家电话'
        ],
        'district_path' => [
            'title' => '商家地区'
        ],
        'district_detail' => [
            'title' => '详细地址'
        ],
    ),

    /**
     * The edit fields array
     *
     * @type array
     */
    'edit_fields' => array(
        'name' => array(
            'title' => 'Name',
        ),
        'phone' => [
            'title'=>'商家电话',
        ],
        'districts' => [
            'title' => '所属地区',
            'type' => 'relationship',
            'autocomplete' => true,
            'num_options' => 15,
#            'name_field' => 'name',
            'search_fields' => array("CONCAT(name, ' ', initials, ' ', pinyin)"),
        ],
        'district_detail'=> [
            'title'=>'详细地址',
        ]
        /*
        'published_date' => array(
            'title' => 'Published Date',
            'type' => 'datetime',
            'date_format' => 'yy-mm-dd', //optional, will default to this value
            'time_format' => 'HH:mm',    //optional, will default to this value
        ),
        'created_at' => array(
            'title' => 'Created',
            'type' => 'datetime',
            'editable' => false,
        ),
        'updated_at' => array(
            'title' => 'Updated',
            'type' => 'datetime',
            'editable' => false,
        ),
        */
    ),

    /**
     * The filter fields
     *
     * @type array
     */
    'filters' => array(
        'name' => array(
            'title' => 'Name',
        ),
    ),

    /**
     * The query filter option lets you modify the query parameters before Administrator begins to construct the query. For example, if you want
     * to have one page show only deleted items and another page show all of the items that aren't deleted, you can use the query filter to do
     * that.
     *
     * @type closure
     */
    'query_filter'=> function($query)
    {
#        $query->whereNotNull('parent_id');
    },

    /**
     * This is where you can define the model's custom actions
     */

);