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
use App\Topic;

Route::get('/', function () {
	$topics = Topic::all();
    return view('home', compact('topics'));
});

Route::get('posts', 'PostController@showAllPosts')->middleware('auth');

Route::post('posts', 'PostController@savePost')->middleware('auth');

Route::get('posts/{id}', 'PostController@showPost')->middleware('auth');

Route::post('posts/{id}/delete', 'PostController@deletePost')->middleware('auth');

Route::get('posts/{id}/edit', 'PostController@editPostForm')->middleware('auth');

Route::post('posts/{id}/edit', 'PostController@updatePost')->middleware('auth');

Route::post('posts/{id}/comment', 'CommentController@saveComment')->middleware('auth');

Route::post('posts/{p}/comment/{c}/delete', 'CommentController@deleteComment')->middleware('auth');

Route::post('posts/{p}/comment/{c}/edit', 'CommentController@updateComment')->middleware('auth');

Route::get('people', 'UserController@showUsers')->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
