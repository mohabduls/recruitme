<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard</title>
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
		<script type="text/javascript" src="{{url('assets/js/dashboard.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/js/ckeditor/ckeditor.js')}}"></script>
		<link rel="stylesheet" type="text/css" href="{{url('assets/js/ckeditor/skins/moono-lisa/editor.css')}}">
	</head>
	<body class="bg-light">
		<header>
			<nav class="bg-light pt-2 pb-2">
				<div class="container">
					<div class="clearfix">
						<div class="float-left">
							<a class="text-custom lead font-weight-bolder" href="{{url('/')}}">RecruitME</a>
						</div>
						<div class="float-right">
							<button class="btn btn-custom-rounded" onclick="openMenu()">Menu</button>
						</div>
					</div>
					<div id="recruitme-menu" class="custom-menu bg-light shadow shadow-sm">
						<button class="btn btn-sm btn-block btn-light" onclick="companyProfile()">Company Profile</button>
						<button class="btn btn-sm btn-block btn-light" onclick="openSettings()">Setting</button>
						<a href="{{url('dashboard/logout')}}" class="btn btn-sm btn-block btn-danger">Logout</a>
					</div>
				</div>
			</nav>
		</header>
		<div class="wrapper">
			@yield('DashboardContent')

			<!--include modals-->
			@include('modals.dashboard')
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