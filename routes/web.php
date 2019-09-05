<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//练习
Route::get('studen/add', 'admin\UserController@studen');
Route::post('studen/studenadd_do', 'admin\UserController@studenadd_do')->name('do');
Route::get('studen/lists', 'admin\UserController@lists');
Route::get('studen/mali', 'MailController@index');

// 后台
Route::prefix('admin')->middleware('checklogin')->group(function () {
    Route::get('index', 'admin\UserController@index');
    Route::get('head', 'admin\UserController@head')->name('head');
    Route::get('foot', 'admin\UserController@foot')->name('foot');
    Route::get('left', 'admin\UserController@left')->name('left');
    Route::get('main', 'admin\UserController@main')->name('main');
    

    // 管理员
    Route::get('useradd', 'admin\UserController@useradd')->name('useradd');
    Route::post('useradd_do', 'admin\UserController@useradd_do')->name('useradd_do');
    // 商品
    Route::get('goods', 'admin\GoodsController@goods')->name('goods');
    Route::post('admin/goods_do', 'admin\GoodsController@goods_do')->name('goods_do');
    Route::get('goods_list', 'admin\GoodsController@goods_list')->name('goods_list');
    Route::get('goods_edit/{gid}', 'admin\GoodsController@goods_edit');
    Route::post('goods_update/{gid}', 'admin\GoodsController@goods_update');
    Route::get('goods_delete', 'admin\GoodsController@goods_delete');
    // 分类
    Route::get('category', 'admin\CatController@category')->name('category');
    Route::post('category_do', 'admin\CatController@category_do')->name('category_do');
    Route::get('category_list', 'admin\CatController@category_list')->name('category_list');
    // 品牌
    Route::get('brand', 'admin\BrandController@brand')->name('brand');
    Route::post('brand_do', 'admin\BrandController@brand_do')->name('brand_do');
    Route::get('brand_list', 'admin\BrandController@brand_list')->name('brand_list');
    Route::get('brand_delete', 'admin\BrandController@brand_delete');
    Route::get('brand_exit/{id}', 'admin\BrandController@brand_exit');
    Route::post('brand_update/{id}', 'admin\BrandController@brand_update');
    //友情链接
     Route::get('friend', 'admin\FriendController@friend')->name('friend');
    Route::post('friend_do', 'admin\FriendController@friend_do')->name('friend_do');
    Route::get('friend_list', 'admin\FriendController@friend_list')->name('friend_list');
    Route::get('friend_exit/{w_id}', 'admin\FriendController@friend_exit');
    Route::get('friend_delete', 'admin\FriendController@friend_delete')->name('friend_delete');
    Route::post('friend_update/{w_id}', 'admin\FriendController@friend_update');



});
//邮件路由
    Route::get('mail/index','MailController@index');
    // 登陆
    Route::get('login_del', 'admin/LoginController@login_del')->name('login_del');
    Route::get('login', 'admin/LoginController@login');
    Route::post('login_do', 'admin/LoginController@login_do')->name('login_do');

Route::prefix('index')->group(function () {
    //首页
    Route::get('index', 'index\indexController@index');
    //商品列表
    Route::get('list', 'index\ListController@list');
    Route::get('xiangqing/{id}', 'index\ListController@xiangqing');
    Route::get('sousuo', 'index\ListController@sousuo');
    //购物车
    Route::get('car', 'index\CarController@car');
    Route::post('delete', 'index\CarController@delete');
    Route::post('getMoney', 'index\CarController@getMoney');
    //用户页
    Route::get('user', 'index\UserController@user');
    Route::get('user_address', 'index\UserController@user_address');
    //确认订单
    Route::get('order', 'index\OrderController@order');
    Route::post('order_do', 'index\OrderController@order_do');
    Route::get('address', 'index\OrderController@address');
    Route::post('address_do', 'index\OrderController@address_do');
    Route::post('save', 'index\OrderController@save');
    Route::get('add_address', 'index\OrderController@add_address');
    Route::post('paymode', 'index\OrderController@paymode');

    //二维码
    Route::get('erweima', 'index\erweimaController@index');
    

});
    //登录
    Route::get('weixinlogin', 'index\LoginController@weixinlogin');
    Route::get('code', 'index\LoginController@code');
    Route::get('login', 'index\LoginController@login');
    Route::post('login_do', 'index\LoginController@login_do');
    //注册
    Route::get('reg', 'index\RegController@reg');
    Route::post('send', 'index\RegController@send');
    Route::post('reg_do', 'index\RegController@reg_do');

    //练习
    Route::get('user/index', 'UserController@index');
    Route::get('user/admin', 'UserController@admin');

    //周考
    Route::get('student/add', 'StudentController@add');
    Route::post('student/save', 'StudentController@save')->name('save');
    Route::get('student/index', 'StudentController@index');
    Route::get('student/delete/{id}', 'StudentController@delete');
    Route::post('student/jidian', 'StudentController@jidian')->name('jidian');
    Route::post('student/change', 'StudentController@change')->name('change');

    //周考1
    Route::get('kao/login', 'KaoController@login');
    Route::post('kao/logindo', 'KaoController@logindo');
    Route::get('kao/add', 'KaoController@add');
    Route::get('kao/index', 'KaoController@index');
    Route::post('kao/save', 'KaoController@save');
    Route::get('kao/list', 'KaoController@list');
    Route::post('kao/give', 'KaoController@give');
    //周考2
    Route::prefix('ball')->group(function () {
    Route::get('add', 'kaoshi\BallController@add');
    Route::get('index', 'kaoshi\BallController@index');
    Route::post('save', 'kaoshi\BallController@save');
    Route::get('jieguo', 'kaoshi\BallController@jieguo');
    Route::get('jingcai', 'kaoshi\BallController@jingcai');
    Route::get('kongzhi', 'kaoshi\BallController@kongzhi');
    Route::post('create', 'kaoshi\BallController@create');
    Route::post('insert', 'kaoshi\BallController@insert');
    });

    //月考
    Route::prefix('huowu')->middleware('checklogin')->group(function () {
    Route::get('login', 'huowu\HuowuController@login');
    Route::post('login_do', 'huowu\HuowuController@login_do');
    Route::get('ruku', 'huowu\HuowuController@ruku');
    Route::get('index', 'huowu\HuowuController@index');
    Route::post('save', 'huowu\HuowuController@save');
    Route::get('chu', 'huowu\HuowuController@chu');
    Route::post('chu_do', 'huowu\HuowuController@chu_do');
    Route::get('ru', 'huowu\HuowuController@ru');
    Route::post('ru_do', 'huowu\HuowuController@ru_do');
      });
    