@extends('layouts.app')

@section('content')
	
	<section class="people-heading py-4">
		<h1 class="px-3"><span class="text-muted">Search</span> <strong>People</strong></h1>
	</section>

	<div class="container-fluid py-4 people-wrapper">
		<div class="row">
			<div class="col col-sm-8">
				<div class="row">
					@foreach($users as $user)
						<div class="clearfix col-md-6">
							<div class="card mb-4 inner-card">
								<div class="card-header cleafix py-3">
									<div class="float-right">
										<div class="follow mt-2">
											<a href="#" class="px-3 py-2"><i class="fas fa-user-plus"></i> Follow</a>
										</div>
									</div>

									<div class="profile-summary">
										<a href="#" class="user-pic float-left p-3 mr-3">A</a>
										<div class="user-details">
											<h5><a href="#">{{ $user->name }}</a></h6>
											<h6>User</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>

			<div class="col col-sm-4">
				
			</div>
		</div>
	</div>

@endsection