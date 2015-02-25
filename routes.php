<?php

Route::pattern('phone', '\d{11}');
Route::pattern('id', '\d+');


Route::group(['namespace' => 'Controllers'], function () {
    Route::get('/', ['as' => 'test', 'uses' => 'HomeController@index']);

    //登录

    Route::get('login', [ 'as' => 'auth.login', 'uses' => 'AuthController@getLogin' ]);
    Route::post('login', 'AuthController@postLogin');
    Route::get('register', [ 'as' => 'auth.register', 'uses' => 'AuthController@getRegister']);
    Route::post('register', 'AuthController@postRegister');
    Route::get('logout', [ 'as' => 'auth.logout', 'uses' => 'AuthController@getLogout' ]);

    //END

    //注册
    //手机验证码
    Route::get('register/{phone}', 'AuthController@getCode');
    //end

    //重置密码
    Route::controller('password', 'RemindersController');
    //end


//个人中心

    //个人中心
    Route::get('member', ['as'=> 'member.index', 'uses'=>'MembersController@getIndex']);


    //头像接口
    Route::get('member/avatar', 'MembersController@avatar');
    Route::post('member/avatar', ['as' => 'member.avatar', 'uses' => 'MembersController@postAvatar']);
    //end

    //个人资料
    Route::get('member/detail', ['as'=> 'member.detail', 'uses'=>'MembersController@detail']);
    Route::post('member/detail', ['uses'=>'MembersController@postDetail']);

    //重置密码
    Route::get('member/password', ['as'=> 'member.password', 'uses'=>'MembersController@password']);
    Route::post('member/password', ['uses'=>'MembersController@postPassword']);

    //重置密码
    Route::get('member/password', ['as'=> 'member.password', 'uses'=>'MembersController@password']);
    Route::post('member/password', ['uses'=>'MembersController@postPassword']);

    //收货地址
    Route::resource('member/delivery', 'MemberDeliveriesController');
    // //设置默认

    Route::get('member/delivery/default/{id}', ['uses'=>'MemberDeliveriesController@setDefault']);






//end

});


//计划任务
//每天24点清零newfans_yesterday数
#http://weile.app/task/clear-yesterday-fans

//每天24点清零income_yesterday数
#http://weile.app/task/clear-income-yesterday

//地区数据获取
//省级地区获取
#http://weile.app/task/district
//指定ID获取子级地区
#http://weile.app/task/sub-district/33
//end

Route::controller('task', 'Controllers\CronController');
//END

//数据交换api

Route::controller('api', 'Controllers\ApiController');


# Admin routes
Route::group([ 'prefix' => 'admin', 'namespace' => 'Controllers\Admin' ], function () {

    Route::get('login', array(
        'as' => 'admin.login',
        'uses' => 'AuthController@getLogin',
    ));

    Route::post('login', array(
        'uses' => 'AuthController@postLogin',
    ));

    Route::get('logout', array(
        'as' => 'admin.logout',
        'uses' => 'AuthController@getLogout',
    ));

});