@extends('master.job-master')

@section('JobContent')

@if($dataJobPosts->count() > 0)
@foreach($dataJobPosts as $djp)
<div class="container">
	@section('__applyid__',$djp->id)
	@section('__jobtitle__',$djp->title)
	<div class="row">
		<div class="col-lg-12 mt-2">
			@if($errors->count() > 0)
			<div class="alert alert-info">
				<p>Attention!</p>
				@foreach($errors->all() as $err)
				{{$err}}<br>
				@endForeach
			</div>
			@endIf

			@if(!empty(Session::get('success')))
			<div class="alert alert-info">
				<p>Thankyou!</p>
				{{Session::get('success')}}
			</div>
			@endIf
			<div class="bg-custom p-2 text-light">
				<div class="d-flex w-100 justify-content-between">
			      	<h5 class="mb-1">{{$djp->title}}</h5>
			      	<small>Created at {{$djp->created_at->diffForHumans()}}</small>
			    </div>
			    <small>On <strong>{{$djp->categories}}</strong> Categories</small>			    
			</div>
			<div class="bg-light p-2 text-dark rounded-lg">
				<div>
			    	{!! $djp->posts !!}
			    </div>
			</div>
		</div>
	</div>
</div>
@endForeach
@else
<div class="container">
	<div class="alert alert-info">
		<p>Ups!,</p>
		Sorry, This jobs has been deleted!
	</div>
</div>
@endIf
@endSection

