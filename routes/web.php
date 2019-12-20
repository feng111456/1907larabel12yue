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

//  Route::get('/', function () {
//      return view('welcome');
//  });
// //闭包函数路由
// //   Route::get('/',function(){
// //       echo '你好laravel';
// //   });
// //get路由
//  Route::get('/_list','index\Test@_list');
// //post路由
    // Route::post('/loginDo','index\Test@loginDo');
/*品牌路由*/ 
Route::prefix('brand')->middleware('CheckLogin')->group(function () {
    Route::get('create','Admin\Brand@create');
    Route::post('store','Admin\Brand@store');
    Route::get('index','Admin\Brand@index');
    Route::get('destroy/{brand_id}','Admin\Brand@destroy');
    Route::get('edit/{brand_id}','Admin\Brand@edit');
    Route::post('update/{brand_id}','Admin\Brand@update');
    Route::post('checkName','Admin\Brand@checkName');
});
/**分类路由*/
Route::prefix('category')->middleware('CheckLogin')->group(function () {
    Route::get('index','Admin\Category@index');
    Route::get('create','Admin\Category@create');
    Route::post('store','Admin\Category@store');
    Route::get('destroy/{cate_id}','Admin\Category@destroy');
    Route::get('edit/{cate_id}','Admin\Category@edit');
    Route::post('update/{cate_id}','Admin\Category@update');
});
/**管理员路由 */
Route::prefix('admin')->middleware('CheckLogin')->group(function () {
    Route::get('index','Admin\Admin@index');
    Route::get('create','Admin\Admin@create');
    Route::post('store','Admin\Admin@store');
    Route::get('destroy/{id}','Admin\Admin@destroy');
    Route::get('edit/{id}','Admin\Admin@edit');
    Route::post('update/{id}','Admin\Admin@update');
});
/**商品路由 */
Route::prefix('goods')->middleware('CheckLogin')->group(function () {
    Route::get('index','Admin\Goods@index');
    Route::get('create','Admin\Goods@create');
    Route::post('store','Admin\Goods@store');
    Route::get('destroy/{id}','Admin\Goods@destroy');
    Route::get('edit/{id}','Admin\Goods@edit');
    Route::post('update/{id}','Admin\Goods@update');
});

/**管理员登录 */
Route::prefix('login')->group(function () {
    Route::get('login','Admin\Login@login');
    Route::post('LoginDo','Admin\login@LoginDo');
});
/**文章路由 */
Route::prefix('articles')->middleware('CheckLogins')->group(function () {
    Route::get('index','Admin\Articles@index');
    Route::get('create','Admin\Articles@create');
    Route::post('store','Admin\Articles@store');
    Route::post('destroy','Admin\Articles@destroy');
    Route::get('edit/{id}','Admin\Articles@edit');
    Route::post('update/{id}','Admin\Articles@update');
    Route::post('check','Admin\Articles@check');
});
/**管理员登录 */
Route::prefix('logins')->group(function () {
    Route::get('logins','Admin\Logins@logins');
    Route::post('LoginsDo','Admin\logins@LoginsDo');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
///---------------------------------------------------------------------
/**前台首页 */
Route::get('/','index\Index@Index');
Route::post('/changeValue','index\Index@changeValue');
/**会员注册/登录 */
Route::get('/login','index\Login@login');
Route::post('/loginDo','index\Login@loginDo');
Route::get('/reg','index\Login@reg');
Route::post('/reg_add','index\Login@reg_add');
Route::post('/code','index\Login@code');
Route::post('/checkCode','index\Login@checkCode');
Route::get('/test','index\Login@test');
//————————————————————————————————————————————————————————————————
/**商品 */
Route::get('/goods_list','index\Goods@goods_list');
Route::get('/prolist/{id}','index\Goods@prolist');
/**购物车列表 */
Route::get('/car','index\Car@Car');
Route::post('/changeBuy_bumber','index\Car@changeBuy_bumber');
Route::post('/changePrice','index\Car@changePrice');
Route::post('/AllPrice','index\Car@AllPrice');
Route::post('/del','index\Car@del');
/**购物车添加 */
Route::post('/car_add','index\Car@car_add');
/**订单方法 */
Route::get('/pay','index\Pay@pay');
Route::get('/pay_test','index\Pay@pay_test');
Route::post('/order','index\Pay@order');
Route::get('/subOrder','index\Pay@subOrder');
/**用户地址 */
Route::get('/address','index\Address@add_show');
Route::post('/add','index\Address@add');
Route::post('/getAddress','index\Address@getAddress');