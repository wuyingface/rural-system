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


/*-------------------------------用户操作 Start------------------------------------*/

//文章列表
Route::resource('articles', 'ArticlesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
//分类列表
Route::resource('articleCategories', 'ArticleCategroiesController', ['only' => ['show']]);
//文章上穿图片
Route::post('upload_image', 'ArticlesController@uploadImage')->name('articles.upload_image');


