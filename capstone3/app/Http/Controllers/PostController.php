<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Auth;
use Illuminate\Http\Request;
class PostController extends Controller
{
    public function showPosts() {
    	$posts = Post::all();
    	$topics = Topic::all();
    	return view('pages/post', compact('posts', 'topics'));
    }

    public function savePost(Request $request) {

    	$post = new Post;
    	$post->title = $request->title;
    	$post->content = $request->content;
    	$post->video = '';
		$post->user_id = Auth::user()->id;
    	$post->topic_id = $request->topic_id;

    	if ($request->hasFile('image')) {

    		$filename = $request->file('image')->getClientOriginalName();

    		$request->file('image')->storeAs('public/upload', $filename);

    		$post->image = $filename;
    	}
    	$post->save();

    	return redirect('/posts');
    }

    public function deletePost($id) {
    	Post::find($id)->delete();
    	return redirect('/posts');
    }

    public function editPost($id) {
    	$post = Post::find($id);

    	return view('pages/edit', compact('post'));
    }
}
