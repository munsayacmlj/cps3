<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Auth;
use App\Events\MessagePosted;

class MessageController extends Controller
{
    public function getMessage() {
    	return Message::with('user')->get();
    }

    public function saveMessage(Request $request) {
    	// $message = new Message();
    	// $message->message = $request->message;
    	// $message->user_id = Auth::user()->id;
    	// $message->save();
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => request()->get('message')
        ]);
     //    $rowMessage = Message::with('user')->get();
     //    $user = Auth::user();
        // Announce that a new message has been posted
        broadcast(new MessagePosted($message, $user))->toOthers();

        return redirect('/messages');
    	// return ['status' => 'OK'];
    }
}
