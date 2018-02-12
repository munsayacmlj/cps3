@extends('layouts.app')


@section('content')
	<div class="container">
		
		<div id="app">
			<div class="card">
			  <div class="card-header">
			    Chatroom <span class="badge pull-right">@{{ usersInRoom.length }}</span>
			  </div>
			  <div class="card-block">
				<chat-log :messages="messages"></chat-log>
				<chat-composer current-user="{{ Auth::user()->name }}" @messagesent="addMessage"></chat-composer>
			  </div>
			</div>

			{{-- <h1>Chatroom</h1> --}}
		</div>

	</div>
@endsection