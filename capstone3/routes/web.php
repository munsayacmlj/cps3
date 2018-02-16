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

Route::get('/posts', 'PostController@showAllPosts');

Route::post('/posts', 'PostController@savePost');

Route::get('posts/{id}', 'PostController@showPost');

Route::post('/posts/{id}/delete', 'PostController@deletePost');

Route::get('posts/{id}/edit', 'PostController@editPostForm');

Route::post('posts/{id}/edit', 'PostController@updatePost');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
