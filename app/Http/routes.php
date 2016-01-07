<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//BLOG ROUTES

Route::get('/', function () {
    return redirect()->action('Blog\HomeController@index');
});
// Authentication routes...
Route::get('auth/login', 'Blog\Auth\AuthController@getLogin');
Route::post('auth/login', 'Blog\Auth\AuthController@postLogin');
Route::get('auth/logout', 'Blog\Auth\AuthController@getLogout');
// Registration routes...
Route::get('auth/register', 'Blog\Auth\AuthController@getRegister');
Route::post('auth/register', 'Blog\Auth\AuthController@postRegister');

Route::get('home','Blog\HomeController@index');

Route::get('articles/{code}','Blog\ArticlesController@show');
Route::get('articles/{code}/image','Blog\ArticlesController@getImage');






//ADMIN ROUTES

Route::get('admin', 'Admin\AdminController@index');
Route::get('admin/admins', 'Admin\AdminsController@index');
Route::get('admin/users', 'Admin\UsersController@index');
Route::get('admin/users/today', 'Admin\UsersController@today');
Route::get('admin/articles', 'Admin\ArticlesController@index');
Route::get('admin/articles/today', 'Admin\ArticlesController@today');
Route::get('admin/comments', 'Admin\CommentsController@index');
Route::get('admin/comments/today', 'Admin\CommentsController@today');

// Authentication routes...
Route::get('admin/auth/login', 'Admin\Auth\AuthController@getLogin');
Route::post('admin/auth/login', 'Admin\Auth\AuthController@postLogin');
Route::get('admin/auth/logout', 'Admin\Auth\AuthController@getLogout');