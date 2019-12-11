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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PostController@index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('user/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
	Route::post('user/store', ['as' => 'user.store', 'uses' => 'UserController@store']);
	Route::get('user/delete/{id}', ['as' => 'user.delete', 'uses' => 'UserController@destroy']);
	Route::get('user/view/{id}', ['as' => 'user.view', 'uses' => 'UserController@show']);
	Route::post('user/update/{id}', ['as' => 'user.update', 'uses' => 'UserController@update']);
	Route::post('user/updatepassword/{id}', ['as' => 'user.updatepassword', 'uses' => 'UserController@updatepassword']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('post/create', ['as' => 'post.create', 'uses' => 'PostController@create']);
	Route::post('post/store', ['as' => 'post.store', 'uses' => 'PostController@store']);
	Route::get('post/delete/{id}', ['as' => 'post.delete', 'uses' => 'PostController@destroy']);
	Route::get('post/view/{id}', ['as' => 'post.view', 'uses' => 'PostController@show']);
	Route::post('post/update/{id}', ['as' => 'post.update', 'uses' => 'PostController@update']);
	
});