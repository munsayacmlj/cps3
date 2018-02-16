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

Route::get('/posts', 'PostController@showPosts');

Route::post('/posts', 'PostController@savePost');

Route::post('/post/{id}/delete', 'PostController@deletePost');

Route::get('post/{id}/edit', 'PostController@editPost');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
