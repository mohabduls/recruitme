@extends('master.joblists-master')

@section('JobLists')


<div class="container">
	@section('__jobtitle__','Vacancy Available')
	<div class="row">
		<div class="col-lg-12">
			<div class="bg-light p-2 shadow shadow-sm text-custom rounded-lg">
				<div class="clearfix">
					<div class="float-left">
						<p class="display-6">Vacancy Available</p >
					</div>
					<div class="float-right">
						<form action="{{'vacancy'}}" method="GET">
							<div class="input-group input-group-sm mb-3">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<span class="form-label">Find</span>
									</div>
								</div>
								<input class="form-control input-custom" type="text" name="find" placeholder="Find ?">
								<select class="form-control input-custom" name="cat">
									<option value="">Categories</option>
									@foreach($dataCategories as $dc)
									<option value="{{$dc->categories}}">{{$dc->categories}}</option>
									@endForeach
								</select>
								<input class="btn btn-custom-rounded form-control" type="submit" value="Go">
							</div>
						</form>
					</div>
				</div>
				@if($dataJobPosts->count() > 0)
				<div class="list-group">
					@foreach($dataJobPosts as $djp)
					<div class="list-group-item list-group-item-action">
					    <div class="d-flex w-100 justify-content-between">
					      	<h5 class="mb-1">{{$djp->title}}</h5>
					      	<small>Created at {{$djp->created_at->diffForHumans()}}</small>
					    </div>
					    <small>On <strong>{{$djp->categories}}</strong> Categories</small>
					    <div class="clearfix">
					    	<div class="float-right">
					    		<object>
					    			<a href="{{url('job/'.$djp->permalink)}}" class="btn btn-custom-rounded btn-sm" target="__blank">See</a>
					    		</object>
					    	</div>
					    </div>
					</div>
					@endForeach
				</div>
				<div class="clearfix mt-2">
					<div class="float-right">
						{{$dataJobPosts->links()}}
					</div>
				</div>
				@else
				<div class="container">
					<div class="alert alert-info">
						<p>Ups!,</p>
						Sorry, Currently we do not have any vacancy available!
					</div>
				</div>
				@endIf
			</div>
		</div>
	</div>
</div>
@endSection

