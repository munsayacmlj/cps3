<?php

namespace App\Http\Controllers;

use App\Comment;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function saveComment(Request $request, $id) {
    	$comment = new Comment();
    	$comment->comment = $request->comment;
    	$comment->post_id = $id;
    	$comment->user_id = Auth::user()->id;
    	$comment->save();

    	// return response()->json(['time' => $comment->created_at->diffForHumans()]);
    }

    public function deleteComment($p, $c) {
    	// $id = $request->commentId;
    	$comment = Comment::find($c)->delete();
    	// return $c;
    }

    public function updateComment(Request $request, $p, $c) {
    	$comment = Comment::find($c);
    	$comment->comment = $request->input;
    	$comment->save();
    }
}
