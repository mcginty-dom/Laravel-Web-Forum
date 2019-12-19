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

//watch video1 pillbug @ 16m for input through view
Route::get('/', function () {
    return view('welcome');
});

//Post
Route::get('posts', 'PostController@index')->name('posts.index');

Route::get('posts/create', 'PostController@create')
->name('posts.create')->middleware('auth');

Route::post('posts', 'PostController@store')->name('posts.store');

Route::get('posts/{id}', 'PostController@show')->name('posts.show');

Route::delete('posts/{id}', 'PostController@destroy')
->name('posts.destroy')->middleware('auth');

Route::get('posts/{id}/edit', 'PostController@edit')
->name('posts.edit')->middleware('auth');

Route::patch('posts/{id}/edit', 'PostController@update')
->name('posts.update')->middleware('auth');

//Comment
Route::post('comments/{post_id}', 'CommentController@store')
->name('comments.store')->middleware('auth');

Route::delete('comments/{id}', 'CommentController@destroy')
->name('comments.destroy')->middleware('auth');

Route::get('comments/{id}/delete', 'CommentController@delete')
->name('comments.delete')->middleware('auth');

Route::get('comments/{id}/edit', 'CommentController@edit')
->name('comments.edit')->middleware('auth');

Route::patch('comments/{id}/edit', 'CommentController@update')
->name('comments.update')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
