@extends('master.dashboard-master')

@section('DashboardContent')

<div class="container">
	@if($dataCategories->count() == 0 && $dataCompany->count() == 0)
		{{$has = false}}
		<div class="alert alert-info">
			<p>Info</p>
			Companies data and Categories not set!<br>
			Please setup by click setting button!
		</div>
	@else
	<?php $has = true; ?>
	@endIf

	@if($errors->count() > 0)
		<div class="alert alert-info">
			<p>Info</p>
			@foreach($errors->all() as $err)
			{{$err}}<br>
			@endForeach
		</div>
	@endIf

	@if(!empty(Session::get('success')))
		<div class="alert alert-info">
			<p>Info</p>		
			{{Session::get('success')}}<br>
		</div>
	@endIf
	<!--stats-->
	<div class="row">
		<div class="col-lg-3 mt-2">
			<div class="bg-custom p-2 shadow shadow-sm text-light rounded-lg">
				<h4 class="display-4 text-center">{{App\JobPost::count()}}</h4>
				<div class="clearfix">
					<div class="float-left">
						Job Post
					</div>
					<div class="float-right">
						@if($has == true)
							<div class="btn btn-outline-light btn-sm" onclick="addPosts(this)">Create</div>
						@endIf
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 mt-2">
			<div class="bg-custom-2 p-2 shadow shadow-sm text-light rounded-lg">
				<h4 class="display-4 text-center">{{App\Categories::count()}}</h4>
				<div class="clearfix">
					<div class="float-left">
						Categories
					</div>
					<div class="float-right">
						@if($has == true)
							<div class="btn btn-outline-light btn-sm" onclick="addCategories()">Make</div>
						@endIf
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 mt-2">
			<div class="bg-custom-3 p-2 shadow shadow-sm text-light rounded-lg">
				<h4 class="display-4 text-center">{{App\Applicants::count()}}</h4>
				<div class="clearfix">
					<div class="float-left">
						Applicants
					</div>
					<div class="float-right">
						@if($has == true)
							<a href="#applicants" class="btn btn-outline-light btn-sm">See</a>
						@endIf
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 mt-2">
			<div class="bg-light p-2 shadow shadow-sm text-success rounded-lg">
				<h4 class="display-4 text-center">{{App\Applicants::where('status',true)->count()}}</h4>
				<div class="clearfix">
					<div class="float-left">
						White Listed
					</div>
					<div class="float-right">
						@if($has == true && App\Applicants::where('status',true)->count() > 0)
							<a href="#whiteListed" class="btn btn-outline-success btn-sm">Go</a>
						@else
						<a href="#false" class="btn btn-outline-success btn-sm">Not Available</a>
						@endIf
					</div>
				</div>
			</div>
		</div>

		<!--post a job-->
		@if($has == true)
		<div class="col-lg-12 mt-2" id="postEditor" class="postEditor">
			<div class="bg-light p-2 shadow shadow-sm text-custom rounded-lg">
				<p class="display-6">Create a Jobs</p >
				<form method="POST" action="{{url('dahsboard/job/add')}}">
					@csrf
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Job Title</label>
								<input class="form-control input-custom" name="jobTitle">
								<small>Job Title *</small>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label">Job Categories</label>
								<select name="jobCategories" class="form-control input-custom">
									@foreach($dataCategories as $dc)
									<option value="{{$dc->categories}}">{{$dc->categories}}</option>
									@endForeach
								</select>
								<small>Job Categories *</small>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="form-label">Job Description</label>
						<textarea id="ckeditor" name="jobPosts"></textarea>
						<small>Job Description *</small>
					</div>
					<div class="clearfix">
						@if($dataCategories->count() > 0)
						<div class="float-right">
							<button class="btn btn-custom-rounded float-right" type="submit">Publish</button>
						</div>
						@else
						<div class="float-right">
							<div class="alert alert-info">
								<p>Info</p>
								Please make categories first before making new job posts!
							</div>
						</div>
						@endIf
					</div>
				</form>
			</div>
		</div>
		@endIf

		<!--job posts-->
		@if($dataJobPosts->count() > 0)
		<div class="col-lg-12 mt-2">
			<div class="bg-light p-2 shadow shadow-sm text-custom rounded-lg">
				<p class="display-6">Job Post</p >
				<div class="list-group">
					@foreach($dataJobPosts as $djp)
					<a href="#" onclick="editJobPosts(this)" class="list-group-item list-group-item-action" hash="{{$djp->permalink}}">
					    <div class="d-flex w-100 justify-content-between">
					      	<h5 class="mb-1">{{$djp->title}}</h5>
					      	<small>Created at {{$djp->created_at->diffForHumans()}}</small>
					    </div>
					   	<p class="mb-1">{{App\Applicants::where('apply_id',$djp->id)->count()}} Applicants</p>
					    <small>On <strong>{{$djp->categories}}</strong> Categories</small>
					    <div class="clearfix">
					    	<div class="float-right">
					    		<object>
					    			<a href="{{url('job/'.$djp->permalink)}}" class="btn btn-custom-rounded btn-sm" target="__blank">See</a>
					    		</object>
					    	</div>
					    </div>
					</a>
					@endForeach
				</div>
				<div class="clearfix mt-2">
					<div class="float-right">
						{{$dataJobPosts->links()}}
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="col-lg-12 mt-2">
			<div class="alert alert-info">
				<p>Job Posts</p>
				Nothing to show!
			</div>
		</div>
		@endIf

		<!--categories-->
		@if($dataCategories->count() > 0)
		<div class="col-lg-12 mt-2">
			<div class="bg-light p-2 shadow shadow-sm rounded-lg">
				<p class="display-6 text-custom">Categories</p>
				<div class="list-group">
					@foreach($dataCategories as $dc)
						<a onclick="editCategories(this)" data-id="{{$dc->id}}" data-content="{{$dc->categories}}" class="list-group-item list-group-item-action">
						    <div class="d-flex w-100 justify-content-between">
						      	<h5 class="mb-1">{{$dc->categories}}</h5>
						      	<small>{{$dc->created_at->diffForHumans()}}</small>
						    </div>
						   	<p class="mb-1">Categories Data</p>
						    <small>{{App\JobPost::where('categories',$dc->categories)->count()}} Posts with this categories</small>
						</a>
					@endForeach
				</div>
				<div class="clearfix">
					<div class="float-right">
						{{$dataCategories->links()}}
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="col-lg-12 mt-2">
			<div class="alert alert-info">
				<p>Categories</p>
				Nothing to show!
			</div>
		</div>
		@endIf

		<!--applicants-->
		@if($dataApplicants->count() > 0)
		<div class="col-lg-12 mt-2" id="applicants">
			<div class="bg-light p-2 shadow shadow-sm text-custom rounded-lg">
				<p class="display-6">Applicants</p >
				<div class="list-group">
					@foreach($dataApplicants as $da)
					<a href="#applicants" class="list-group-item list-group-item-action" candidates-id="{{$da->id}}" onclick="seeCandidates(this)">
					    <div class="d-flex w-100 justify-content-between">
					      	<h5 class="mb-1">{{$da->name}} - {{$da->age}} years old</h5>
					      	<small>{{$da->created_at->diffForHumans()}}</small>
					    </div>
					   	<p class="mb-1">Apply for <strong>{{App\JobPost::where('id',$da->apply_id)->first()->title}}</strong></p>
					    <small>Email to <strong>{{$da->email}}</strong> and Calls to <strong>{{$da->number_phone}}</strong></small>
					</a>
					@endForeach
				</div>
				<div class="clearfix">
					<div class="float-right">
						{{$dataApplicants->links()}}
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="col-lg-12 mt-2">
			<div class="alert alert-info">
				<p>Applicants</p>
				Nothing to show!
			</div>
		</div>
		@endIf

		<!--whitelisted-->
		@if($dataWhiteLists->count() > 0)
		<div class="col-lg-12 mt-2" id="whiteListed">
			<div class="bg-light p-2 shadow shadow-sm text-custom rounded-lg">
				<p class="display-6">Whitelist</p>
				<div class="list-group">
					@foreach($dataWhiteLists as $da)
					<a href="#whiteListed" class="list-group-item list-group-item-action" candidates-id="{{$da->id}}" onclick="seeCandidates(this)">
					    <div class="d-flex w-100 justify-content-between">
					      	<h5 class="mb-1">{{$da->name}} - {{$da->age}} years old</h5>
					      	<small>{{$da->created_at->diffForHumans()}}</small>
					    </div>
					   	<p class="mb-1">Apply for <strong>{{App\JobPost::where('id',$da->apply_id)->first()->title}}</strong></p>
					    <small>Email to <strong>{{$da->email}}</strong> and Calls to <strong>{{$da->number_phone}}</strong></small>
					</a>
					@endForeach
				</div>
				<div class="clearfix">
					<div class="float-right">
						{{$dataWhiteLists->links()}}
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="col-lg-12 mt-2">
			<div class="alert alert-info">
				<p>White Listed</p>
				Nothing to show!
			</div>
		</div>
		@endIf
	</div>
</div>
@endSection