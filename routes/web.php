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

//显示首页
Route::get('/', 'PagesController@root')->name('root');

//获取首页地区信息
Route::get('/getArea', 'PagesController@getArea');



/*-------------------------------用户认证 Start------------------------------------*/

//Auth::routes();等同于以下路由

// 用户登陆退出
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 用户注册
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 找回密码
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/*-------------------------------用户认证 End------------------------------------*/


//用户个人中心
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);


/*-------------------------------文章板块 Start------------------------------------*/

//文章列表
Route::resource('articles', 'ArticlesController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('articles/{article}/{slug?}', 'ArticlesController@show')->name('articles.show');//为文章详情页兼容友好的URL
//分类列表下的文章
Route::resource('articleCategories', 'ArticleCategroiesController', ['only' => ['show']]);
//乡村板块下分类列表的文章
Route::get('articleCategories/{articleCategory_id}/{rural_id}', 'ArticleCategroiesController@getRuralArticles');
//文章上传图片
Route::post('upload_image', 'ArticlesController@uploadImage')->name('articles.upload_image');
//文章回复
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);
//消息通知
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

//消息通知
Route::get('introduction', function () {
	return view('introduction.introduction');
});

/*---------------------------------文章板块 End-------------------------------------*/



/*---------------------------------乡村板块 Start-----------------------------------*/

//乡村板块
Route::resource('rurals', 'RuralsController', ['only' => ['update', 'edit']]);
Route::get('rurals/{rural}/{slug?}', 'RuralsController@show')->name('rurals.show');//为乡村详情页兼容友好的URL
//文章上传图片
Route::post('upload_rarul_img', 'ArticlesController@uploadImage')->name('rurals.upload_rarul_img');

/*---------------------------------乡村板块 End--------------------------------------*/
