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

Route::any('/','IndexController@index');
route::any('userpage','IndexController@userpage');
route::any('sharedetail','IndexController@sharedetail');

Route::prefix('goods')->group(function () {
    route::any('goodslist','Index\GoodsController@goodslist');
    route::any('shopcontent','Index\GoodsController@shopcontent');
    route::any('category','Index\GoodsController@category');

});

Route::prefix('cart')->group(function(){
    route::any('cartlist','Index\CartController@cartlist');
    route::any('cart','Index\CartController@cart');
    route::any('changeNum','Index\CartController@changeNum');
    route::any('del','Index\CartController@del');
    route::any('delall','Index\CartController@delall');
    route::any('sid','Index\OrderController@sid');
});

Route::prefix('login')->group(function(){
    route::any('login','Index\Login@login');
    route::any('logindo','Index\Login@logindo');
    route::any('register','Index\Login@register');
    route::any('registerdo','Index\Login@registerdo');
});

Route::prefix('order')->group(function(){
    route::any('payment','Index\OrderController@payment');
    route::any('address','Index\OrderController@address');
    route::any('addressadd','Index\OrderController@addressadd');
});


route::any('verify/create','CaptchaController@create');
route::any('verify/creates','CaptchaController@creates');
route::any('sendcode','Index\Login@sendcode');

route::any('test','Index\CartController@test');