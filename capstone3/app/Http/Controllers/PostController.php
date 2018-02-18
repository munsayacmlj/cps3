<?php

namespace App\Http\Controllers;

use File;
use App\Post;
use App\Topic;
use App\Comment;
use Auth;
use Illuminate\Http\Request;
class PostController extends Controller
{
    public function showAllPosts() {
    	$posts = Post::all();
    	$topics = Topic::all();
       
    	return view('pages/allposts', compact('posts', 'topics'));
    }

    public function showPost($id) {
        $post = Post::find($id);
        $topics = Topic::all();
        
        return view('pages/post', compact('post', 'topics'));
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
        else{
            $post->image = '';
        }
    	$post->save();

    	return redirect('/posts');
    }

    public function deletePost($id) {
        Comment::where('post_id', $id)->delete();
    	Post::findOrFail($id)->delete();
    	return redirect('/posts');
    }

    public function editPostForm(Request $request, $id) {
    	$post = Post::find($id);
        $topics = Topic::all();
        $ip = $request->getClientIp();
    	return view('pages/edit', compact('post', 'topics', 'ip'));
    }

    public function updatePost(Request $request, $id) {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->topic_id = $request->topic;

        if ($request->delete_image) {
            $image_path = public_path() . '\\storage\\upload\\' . $post->image;
            unlink($image_path);
            $post->image = "";
        }
        
        if ($request->hasFile('image')) {
            
            $filename = $request->file('image')->getClientOriginalName();

            $request->file('image')->storeAs('public/upload', $filename);

            $post->image = $filename;
        }

        $post->save();

        $url = "posts/".$id;
        return redirect($url);
        // return view('pages/post');

    }
}
