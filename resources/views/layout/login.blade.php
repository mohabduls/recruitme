@extends('master.login-master')

@section('LoginContent')

<div class="container mt-5">
	<div class="d-flex justify-content-center">
		<form class="form-custom p-4 bg-light shadow shadow-sm" method="POST" action="{{url('auth')}}">
			@csrf
			<div class="d-flex justify-content-center">
				<img src="{{url('assets/img/recruitme.png')}}" alt="RecruitME Logo" class="img-logo">
			</div>
			<p class="lead text-center text-custom">RecruitME</p>
			@if($errors->count() > 0)
			<div class="alert alert-danger">
				<p class="alert-header">Warning!</p>
				<ul>
					@foreach($errors->all() as $err)
						<li>{{$err}}</li>
					@endForeach
				</ul>
			</div>
			@endIf
			<div class="form-group">
				<label class="form-label text-dark">Username</label>
				<input class="form-control input-custom" type="text" name="username" placeholder="Username">
				<small>Username *</small>
			</div>
			<div class="form-group">
				<label class="form-label text-dark">Password</label>
				<input class="form-control input-custom" type="password" name="password" placeholder="********">
				<small>Password *</small>
			</div>
			<button class="btn btn-sm btn-custom-login btn-block p-2">Login</button>
		</form>
	</div>
</div>

@endSection