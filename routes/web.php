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

Route::get('/', function () {
	$name='欢迎进入laravel';
    return view('welcome',['name'=>$name]);
});
Route::get('/show', function () {
	echo'这里是商品详情页';
    
});
Route::get('/show/{id}', function ($id) {
	
    return '商品id是'.$id;
});
Route::get('/show/{id}/{name}', function ($id, $name) { 
	return '商品id是'.$id . '-' .'关键字是'.$name;
 });
Route::get('/show/{id}/{name}', function ($id, $name) { 
	echo '商品id：';
	echo $id;
	echo '商品名称:';
	echo $name;
 })->where(['name'=>'\w+']);
// Route::get('/cate', function () {
// 	$id='服装';
//     return view('cate/add',['id'=>$id]);
// });
// Route::get('/user', 'UserController@index');
// Route::get('/adduser', 'UserController@add');
// Route::get('/adddo', 'UserController@adddo')->name('do');
// 
// Route::get('/people', 'WorkController@add');
// Route::post('/add_do', 'WorkController@add_do');
// Route::get('/list', 'WorkController@list');
// Route::get('/people/edit/{id}', 'WorkController@edit');
// Route::post('/people/update/{id}', 'WorkController@update');
// Route::get('/people/delete/{id}', 'WorkController@delete');

// Route::get('/student', 'StudentController@add')->middleware('checklogin');
// Route::post('/creat', 'StudentController@creat')->middleware('checklogin');
// Route::get('/list', 'StudentController@list')->middleware('checklogin');
// Route::get('/edit/{id}', 'StudentController@edit')->middleware('checklogin');
// Route::post('/update/{id}', 'StudentController@update')->middleware('checklogin');
// Route::get('/delete/{id}', 'StudentController@delete')->middleware('checklogin');

// Route::get('/brand', 'BrandController@add');
// Route::post('/do_add', 'BrandController@do_add');
// Route::get('/list', 'BrandController@list');
// Route::get('/delete/{id}', 'BrandController@delete');
// Route::get('/edit/{id}', 'BrandController@edit');
// Route::post('/update/{id}', 'BrandController@update');
// 
Route::get('/login', 'LoginController@login');
Route::post('/logindo', 'LoginController@logindo');
Route::prefix('/paper')->middleware('checklogin')->group(function(){
Route::get('/add', 'PaperController@add');
Route::post('/do_add', 'PaperController@do_add');
Route::get('/list', 'PaperController@list');
Route::get('/destroy/{id}', 'PaperController@destroy');
Route::get('/edit/{id}', 'PaperController@edit');
Route::post('/update/{id}', 'PaperController@update');
Route::post('/checkonly', 'PaperController@checkonly');
});
Route::get('/cate/add', 'CateController@add');
Route::post('/cate/do_add', 'CateController@do_add');
Route::get('/cate/list', 'CateController@list');
Route::get('/cate/del/{id}', 'CateController@del');
Route::get('/cate/edit/{id}', 'CateController@edit');
Route::post('/cate/update/{id}', 'CateController@update');

//商品表路由
Route::get('/goods/create', 'GoodsController@create');
Route::post('/goods/store', 'GoodsController@store');
Route::get('/goods/index', 'GoodsController@index');
Route::get('/goods/del/{id}', 'GoodsController@del');
Route::get('/goods/edit/{id}', 'GoodsController@edit');
Route::post('/goods/update/{id}', 'GoodsController@update');

//管理员路由
Route::get('/admin/create', 'AdminController@create');
Route::post('/admin/store', 'AdminController@store');
Route::get('/admin/index', 'AdminController@index');
Route::get('/admin/destroy/{id}', 'AdminController@destroy');
Route::get('/admin/edit/{id}', 'AdminController@edit');
Route::post('/admin/update/{id}', 'AdminController@update');

//前台
Route::get('/shop/index', 'index\IndexController@index');
Route::view('/shop/login', 'index.login');
Route::view('/shop/register', 'index.register');
Route::get('/setCookie', 'index\IndexController@setCookie');
Route::get('/ajaxsend', 'index\LoginController@ajaxsend');
Route::get('/shop/pay', 'index\IndexController@pay');
Route::post('/shop/do_login', 'index\LoginController@do_login');
Route::post('/shop/do_register', 'index\LoginController@do_register');
Route::get('/shop/protect/{id}', 'index\IndexController@protect');
Route::get('/shop/add_cart', 'index\IndexController@add_cart');
Route::get('/shop/cart', 'index\IndexController@cart');
Route::get('/send', 'index\LoginController@sendEmail');
//周测
Route::get('/homework/login', 'HomeworkController@login');
Route::post('/homework/do_login', 'HomeworkController@do_login');
Route::get('/homework/index', 'HomeworkController@index');
Route::get('/homework/destroy/{id}', 'HomeworkController@destroy');
Route::get('/homework/create', 'HomeworkController@create');
Route::get('/homework/user', 'HomeworkController@user');
Route::get('/homework/add', 'HomeworkController@add');
Route::post('/homework/do_add', 'HomeworkController@do_add');
