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
    'title' => '分类列表',

    /**
     * The singular name of your model
     *
     * @type string
     */
    'single' => '分类',

    /**
     * The class name of the Eloquent model that this config represents
     *
     * @type string
     */
    'model' => 'Category',

    /**
     * The columns array
     *
     * @type array
     */
    'columns' => array(
        'id' => [
            'title' => 'ID',
        ],
        'path' => array(
            'title' => '分类关系',
        ),
        'name' => ['title'=>'分类名称'],
        'updated_at' => array(
            'title' => '更新时间'
        ),
    ),

    /**
     * The edit fields array
     *
     * @type array
     */
    'edit_fields' => array(
        'parent' => array(
            'title' => 'Parent',
            'type' => 'relationship',
            'name_field' => 'path',
            'options_sort_field' => 'lft',
        ),
        'name' => array(
            'title' => 'Name',
        ),
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
    'actions' => array(
        // Ordering an item up / left
        'order_up' => array(
            'title' => '升序',
            'messages' => array(
                'active' => 'Reordering...',
                'success' => 'Reordered',
                'error' => 'There was an error while reordering',
            ),
            'permission' => function($model)
            {
                if (!Request::segment(3))
                {
                    return false;
                }
                $model = $model->where('id','=',Request::segment(3))->first();
                if (!is_object($model))
                {
                    return false;
                }
                return !is_null($model->getLeftSibling());
            },
            //the model is passed to the closure
            'action' => function($model)
            {
                return $model->moveLeft();
            }
        ),
        // Ordering an item down / right
        'order_down' => array(
            'title' => '降序',
            'messages' => array(
                'active' => 'Reordering...',
                'success' => 'Reordered',
                'error' => 'There was an error while reordering',
            ),
            'permission' => function($model)
            {
                if (!Request::segment(3))
                {
                    return false;
                }
                $model = $model->where('id','=',Request::segment(3))->first();
                if (!is_object($model))
                {
                    return false;
                }
                return !is_null($model->getRightSibling());
            },
            //the model is passed to the closure
            'action' => function($model)
            {
                return $model->moveRight();
            }
        ),

    ),

    /**
     * The validation rules for the form, based on the Laravel validation class
     *
     * @type array
     */
    'rules' => array(
        'name' => 'required|max:255',
    ),

    /**
     * The sort options for a model
     *
     * @type array
     */
    'sort' => array(
        'field' => 'lft',
        'direction' => 'asc',
    ),

);