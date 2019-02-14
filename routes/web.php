<?php

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route Starts
Auth::routes();
Route::get('page', 'PageController@initListing');
	// @front PageController routes@ Added from component controller
Route::get('page/{url}', 'PageController@initContent');

Route::get('product', 'ProductController@initListing');
Route::get('product/{url}', 'ProductController@initContent');


// Route::get('test', 'TestController@initListing');
// Route::get('test/{url}', 'TestController@initContent');

// Route::get('/', 'PageController@initContentHome');

Route::group(['middleware' => 'guest'], function () {
  Route::get('login', 'AuthController@initContentLogin')->name('login');
  Route::post('login', 'AuthController@initProcessLogin');

  Route::get('password/reset', 'AuthController@initContentPasswordReset')->name('password.email');
  Route::post('password/reset', 'AuthController@initProcessSendResetLink')->name('password.reset');

  Route::get('password/reset/{token}', 'AuthController@initContentSetNewPassword')->name('password.request');
  Route::post('password/reset/{token}', 'UserController@initProcessResetPassword');

  Route::get('register', 'Auth\RegisterController@initContent')->name('register');
  Route::post('register', 'Auth\RegisterController@initProcessRegister');
});

// Blog
Route::get('blog', 'BlogController@initListing')->name('blogs');
Route::get('blog/post/{url}', 'BlogController@initContentPost')->name('blog-post');
Route::get('blog/category/{category}', 'BlogController@initListingCategory')->name('blog-post-category');
Route::get('blog/author/{id}/{url}', 'BlogController@initListingAuthor')->name('blog-post-author');

Route::group(['middleware' => 'auth'], function () {
  Route::get('logout', 'AuthController@initProcessLogout')->name('logout');
});
// Auth::routes();

Route::get('/user/dashboard', 'UserController@initContent')->name('user.dashboard');

Route::get('{p1?}/{p2?}/{p3?}/{p4?}/{p5?}', 'PageController@initContent');
