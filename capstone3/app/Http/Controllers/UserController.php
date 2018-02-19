<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUsers() {
    	$users = User::all();

    	return view('/pages/people', compact('users'));
    }

    public function userPreview($name) {

    	$userId = Auth::user()->id;
    	$user = User::find($userId);

    	return view('/pages/person', compact('user'));
    }
}
