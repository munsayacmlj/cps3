@extends('layouts.app')

@section('content')
	
	<div class="container-fluid py-4" style="background-color: #fff;">
		<div class="row px-3">
			@foreach ($posts as $post)
			<div class="col col-sm-4 col-md-4 col-xl-2 outer-card" id="card_{{ $post->id }}">
				<div class="card">
					<div class="card-header">
						<span class="card-poster h5 float-left">{{ $post->user->name }}</span>
						<span class="float-right">
                        @auth    
							@if ($post->user->name == Auth::user()->name)
							<a href='{{ url("posts/$post->id/edit") }}' class="edit-post">
								<i class="far fa-edit"></i>
							</a>
							<a href="#" class="delete-post" data-id="{{ $post->id }}">
								<i class="far fa-trash-alt"></i>
							</a>
							@endif
                        @endauth
						</span>
					</div>
					<div class="card-body">
						<div class="card-title h5 pb-1">{{ $post->title }}</div>
						<p>{{ $post->content }}</p>
					</div>
					@if ($post->image != NULL)
                        <a href='{{ url("posts/$post->id") }}'>
    						<img src='{{ asset("storage/upload/$post->image") }}'>
    					</a>
                    @endif
					<div class="card-footer">
						<p class="m-0">
							<i class="fas fa-tag"></i>
							Posted in
							<a href="#">{{ $post->topic->topic }}</a>
							<br>
							<i class="far fa-clock"></i>
							{{ $post->created_at->diffForHumans() }}
						</p>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	

	<div class="modal fade stick-up" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding: 0;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header mt-2" style="border-bottom: none;">
            <h5 class="modal-title" id="exampleModalLabel"><span class="text-muted h3">New</span> <span class="h3">Post</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           @auth
            <form action="/posts" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="topic form-group w-75">
                    <label>Topic</label>
                    <select class="form-control" name="topic_id">
                        @foreach ($topics as $topic)
                        <option value="{{ $topic->id }}">{{ $topic->topic }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="title form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title..." required>
                </div>

                <div class="text form-group">
                    <label>Text</label>
                    <textarea rows="7" class="form-control" placeholder="Say Something..." name="content"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Photo</label>
                        <div class="input-group">
                            <input type="text" id="filename" class="form-control" placeholder="No file selected" readonly>
                            <span class="input-group-btn">
                                <div class="btn btn-default custom-file-uploader">
                                    <input type="file" name="image" id="image">
                                    <i class="fas fa-folder-open fa-2x"></i>                    
                                </div>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </div>
            </form>
            @else
                <div class="h2">
                    Please Sign in
                </div>
            @endauth
          </div>
          {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>  --}}
        </div>
      </div> 
    </div> <!-- /.modal -->
@endsection