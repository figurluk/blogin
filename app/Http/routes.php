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

// Authentication routes...
Route::get('auth/login', 'Blog\Auth\AuthController@getLogin');
Route::post('auth/login', 'Blog\Auth\AuthController@postLogin');
Route::get('auth/logout', 'Blog\Auth\AuthController@getLogout');
// Registration routes...
Route::get('auth/register', 'Blog\Auth\AuthController@getRegister');
Route::post('auth/register', 'Blog\Auth\AuthController@postRegister');

Route::get('/','Blog\HomeController@index');
Route::get('home','Blog\HomeController@index');
Route::get('home/more/{count}','Blog\HomeController@more');
Route::get('home/next/{start}','Blog\HomeController@next');

Route::get('home/tags/{code}','Blog\TagsController@show');
Route::get('home/tags/{code}/more/{count}','Blog\TagsController@more');
Route::get('home/tags/{code}/next/{start}','Blog\TagsController@next');
Route::get('home/tags/{code}/{month}/{year}','Blog\TagsController@filterShow');
Route::get('home/tags/{code}/{month}/{year}/more/{count}','Blog\TagsController@filterMore');
Route::get('home/tags/{code}/{month}/{year}/next/{start}','Blog\TagsController@filterNext');

Route::get('home/{month}/{year}','Blog\HomeController@filterIndex');
Route::get('home/{month}/{year}/more/{count}','Blog\HomeController@filterMore');
Route::get('home/{month}/{year}/next/{start}','Blog\HomeController@filterNext');


Route::get('articles/{code}','Blog\ArticlesController@show');
Route::post('articles/{code}/comment','Blog\ArticlesController@comment');
Route::get('articles/{code}/image','Blog\ArticlesController@getImage');


//ADMIN ROUTES

Route::get('admin', 'Admin\AdminController@index');
Route::get('admin/admins', 'Admin\AdminsController@index');
Route::get('admin/admins/create', 'Admin\AdminsController@create');
Route::post('admin/admins/store', 'Admin\AdminsController@store');
Route::get('admin/admins/{id}/edit', 'Admin\AdminsController@edit');
Route::post('admin/admins/{id}/update', 'Admin\AdminsController@update');
Route::get('admin/admins/{id}/remove', 'Admin\AdminsController@remove');

Route::get('admin/users', 'Admin\UsersController@index');
Route::get('admin/users/today', 'Admin\UsersController@today');
Route::get('admin/users/create', 'Admin\UsersController@create');
Route::post('admin/users/store', 'Admin\UsersController@store');
Route::get('admin/users/{id}/edit', 'Admin\UsersController@edit');
Route::post('admin/users/{id}/update', 'Admin\UsersController@update');
Route::get('admin/users/{id}/remove', 'Admin\UsersController@remove');

Route::get('admin/articles', 'Admin\ArticlesController@index');
Route::get('admin/articles/today', 'Admin\ArticlesController@today');
Route::get('admin/articles/create', 'Admin\ArticlesController@create');
Route::post('admin/articles/store', 'Admin\ArticlesController@store');
Route::get('admin/articles/{id}/edit', 'Admin\ArticlesController@edit');
Route::post('admin/articles/{id}/update', 'Admin\ArticlesController@update');
Route::get('admin/articles/{id}/remove', 'Admin\ArticlesController@remove');

Route::get('admin/tags', 'Admin\TagsController@index');
Route::get('admin/tags/create', 'Admin\TagsController@create');
Route::post('admin/tags/store', 'Admin\TagsController@store');
Route::get('admin/tags/{id}/edit', 'Admin\TagsController@edit');
Route::post('admin/tags/{id}/update', 'Admin\TagsController@update');
Route::get('admin/tags/{id}/remove', 'Admin\TagsController@remove');

Route::get('admin/comments', 'Admin\CommentsController@index');
Route::get('admin/comments/today', 'Admin\CommentsController@today');
Route::get('admin/comments/create', 'Admin\CommentsController@create');
Route::post('admin/comments/store', 'Admin\CommentsController@store');
Route::get('admin/comments/{id}/edit', 'Admin\CommentsController@edit');
Route::post('admin/comments/{id}/update', 'Admin\CommentsController@update');
Route::get('admin/comments/{id}/remove', 'Admin\CommentsController@remove');

// Authentication routes...
Route::get('admin/auth/login', 'Admin\Auth\AuthController@getLogin');
Route::post('admin/auth/login', 'Admin\Auth\AuthController@postLogin');
Route::get('admin/auth/logout', 'Admin\Auth\AuthController@getLogout');