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
    Route::post('register/code', ['as'=>'auth.code', 'uses'=>'AuthController@postCode']);
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

    //地理位置更新
    Route::get('member/location', 'MembersController@location');
    Route::post('member/location', ['as' => 'member.location', 'uses' => 'MembersController@postLocation']);

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

    //银行卡
    Route::resource('member/bankcard', 'MemberBankCardsController');
    // //设置默认
    Route::get('member/bankcard/default/{id}', ['uses'=>'MemberBankCardsController@setDefault']);


//产品

    //产品列表页 查、
    Route::get('products', ['as'=>'products', 'uses'=>'ProductController@index']);
    Route::get('products/search', ['as'=>'products.search', 'uses'=>'ProductSearchController@search']);

    //产品详情页 添加到购物车、关注
    
    //产品评论页面
    Route::get('products/{id}/reviews', ['as'=>'products.reviews', 'uses'=>'ProductController@reviews']);
    Route::post('products/{id}/reviews', ['as'=>'products.reviews', 'uses'=>'ProductController@postReviews','before'=>'auth']);
    //Route::post('products/{id}/reviews', ['as'=>'products.reviews', 'uses'=>'ProductController@postReviews']);
    //购物车操作 增、删、查、改（增加某一产品数量）。
    Route::resource('shopcart', 'ShopCartController');

    //结算页
    Route::get('settle', ['as'=>'settle', 'uses' => 'SettleController@settle']);
    Route::post('settle', [ 'uses' => 'SettleController@makeOrder']);

    //产品订单页
    Route::resource('orders', 'OrdersController');

    //卡券订单页
    Route::resource('cardorders', 'CardOrdersController');

//商铺
    //商铺列表页
    Route::get('sellers', ['as'=>'sellers', 'uses'=>'SellerController@index']);
    Route::get('sellers/search', ['as'=>'sellers.search', 'uses'=>'SellerController@search']);

    //商铺详情页
    Route::get('sellers/{id}', ['as'=>'sellers.show', 'uses'=>'SellerController@show']);
    //商铺基本信息页
    Route::get('sellers/detail/{id}', ['uses'=>'SellerController@detail']);

//卡券
    //卡券订单页
    Route::resource('orders', 'OrdersController');
    //储值卡详情页
    Route::get('sellers/cardstored/{id}', ['uses'=>'SellerController@cardStored']);
    //储值卡订单页
    Route::get('sellers/orderstored/{id}', ['as'=>'order.stored','uses'=>'SellerController@orderStored']);
    //提交储值卡订单
    Route::post('cardstoredsettle', ['as'=>'order.stored.post','uses'=>'SettleController@makeOrderCardStored']);

    //会员卡详情页
    Route::get('sellers/cardvip/{id}', ['uses'=>'SellerController@cardVip']);
    //会员卡领取
    Route::post('cardvipsettle', ['as'=>'order.vip.post','uses'=>'SettleController@makeOrderCardVip']);

    //代金券详情页
    Route::get('sellers/cardvoucher/{id}', ['uses'=>'SellerController@cardVoucher']);
    //代金券订单页
    Route::get('sellers/ordervoucher/{id}', ['as'=>'order.voucher','uses'=>'SellerController@orderVoucher']);
    //提交代金券订单
    Route::post('cardvouchersettle', ['as'=>'order.voucher.post','uses'=>'SettleController@makeOrderCardVoucher']);

    //优惠券详情页
    Route::get('sellers/cardcoupon/{id}', ['uses'=>'SellerController@cardCoupon']);
    //优惠券领取
    Route::post('cardcouponsettle', ['as'=>'order.coupon.post','uses'=>'SettleController@makeOrderCardCoupon']);
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