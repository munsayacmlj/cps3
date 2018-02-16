@extends('layouts.app')

@section('content')

	<div class="container-fluid">
		<div class="row justify-content-md-center px-3">
			<div class="col col-md-10">
				<div class="first-row">
					{{ $post->topic->topic }}
				</div>
			</div>
		</div>
	</div>
@endsection