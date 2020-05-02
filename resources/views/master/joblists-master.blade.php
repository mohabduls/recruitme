<!DOCTYPE html>
<html>
	<head>
		<!--jobtitle-->
		@foreach($dataCompany as $dc)
		<title>{{$dc->name}} - @yield('__jobtitle__')</title>
		@endForeach
		<meta charset="utf-8">
		<meta name="canonical" content="{{url('/')}}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf_token" content="{{csrf_token()}}">

		<!--assets-->
		<link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('assets/css/iziModal.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('assets/css/recruitment.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('assets/css/dashboard.css')}}">
		<script type="text/javascript" src="{{url('assets/js/jquery-3.4.1.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/js/bootstrap.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/js/iziModal.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/js/jobs.js')}}"></script>
	</head>
	<body>
		<header>
			<nav class="bg-light">
				<div class="container p-2">
					<div class="clearfix">
						<div class="float-left">
							@foreach($dataCompany as $dc)
							<a class="navbar-brand text-custom" href="#">{{$dc->name}}</a>
							@endForeach
						</div>
					</div>
				</div>
			</nav>
		</header>
		<div class="wrapper">
			@yield('JobLists')
		</div>
		<footer>
			<div class="container p-5 text-center">
				<strong><small class="text-custom">
					RecruitME v1.0<br>
					&copy; 2020 - <a class="text-custom text-decoration-none" href="https://www.linkedin.com/in/mohabduls" target="__blank">Mohamad Abdul Sobur</a></small></strong>
			</div>
		</footer>

		
	</body>
</html>