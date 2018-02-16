@extends('layouts.app')

@section('content')
	<div class="edit-wrapper p-4">
	<div class="title-edit-page">
		<h2 class="pt-2">{{ $post->title }}</h2>

	</div>
		<div class="container-fluid py-4 outer-edit-box">
			<div class="mx-2 inner-edit-box">
				<div class="header-edit">
					<span class="lead pl-3">Edit Post</span>
				</div>

				<form method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">
						<div class="edit-content col-md-8 left-side">
							<div class="first-row row px-3">
								<div class="form-group col-md-6 col-sm-12 py-3">
									{{-- <div class="col-5 py-3"> --}}
									<label>Topic</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-addon"><i class="fas fa-bookmark"></i></span>
											</div>
											<select name="topic" class="form-control">
												@foreach ($topics as $topic)
													<option value="{{ $topic->id }}" @if($topic->id == $post->topic_id) selected @endif>{{ $topic->topic }}</option>
												@endforeach
											</select>
										</div>
									{{-- </div>  --}}
								</div> {{-- form-group --}}

								<div class="form-group col-md-6 col-sm-12 py-3">
									<label>Youtube Video URL</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-addon"><i class="fab fa-youtube-square"></i></span>
										</div>
										<input type="text" class="form-control" name="youtube" placeholder="YouTube URL...">
									</div>
								</div>
							</div> {{-- first-row --}}

							<div class="second-row">
								<div class="form-group">
									<div class="col py-3">
										<label>Title</label>
										<input type="text" class="form-control" name="title" value="{{ $post->title }}">
									</div>
								</div>
							</div>

							<div class="third-row">
								<div class="form-group">
									<div class="col py-3">
										<label>Text</label>
										<textarea name="content" class="form-control" rows="7">{{ $post->content }}</textarea>
									</div>
								</div>
							</div>

							<div class="fourth-row">
								<div class="col mt-2">
									<input type="submit" name="save_edit" value="Save" class="btn btn-primary float-right px-4">
								</div>
							</div>
						</div> {{-- edit-content --}}

						<div class="col-md-4 right-side pt-3">
							<div class="form-group">
								<label>Image</label>
								<div class="file-input">
									<div class="image-row">
										<div class="inner-image">
											<img src='{{ asset("storage/upload/$post->image") }}' id="image-tag">
										</div>
									</div>
									<span class="input-group-btn">
										 <div class="btn btn-primary btn-sm my-2 custom-file-uploader">
		                                    <input type="file" name="image" id="edit-image">
		                                    <i class="fas fa-folder-open fa-2x"></i>                    
		                                </div>
									</span> 
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="checkbox check-danger">
											<input type="checkbox" name="delete_image" value="y" id="delete_image">
											<label for="delete_image" class="text-muted" style="text-transform: none; font-weight: 400; font-size: 14px;">Remove Image</label>
										</div>
									</div>
								</div>
							</div>
						</div> {{-- right-side --}} 
					</div> {{-- row --}}
				</form>
			</div> {{-- inner-edit-box --}}
		</div>
	</div>

@endsection