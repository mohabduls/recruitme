<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Recruitment Application</title>
		<meta charset="utf-8">
		<meta name="canonical" content="{{url('/')}}">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!--assets-->
		<link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap.css')}}">
		<script type="text/javascript" src="{{url('assets/js/jquery-3.4.1.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/js/bootstrap.js')}}"></script>
		<script type="text/javascript" src="{{url('assets/js/recruitment.js')}}"></script>
		<link rel="stylesheet" type="text/css" href="{{url('assets/css/recruitment.css')}}">
	</head>
	<body class="bg-custom">
		<div class="wrapper">
			@yield('LoginContent')
		</div>
		<footer>
			<div class="container p-5 text-center">
				<strong><small class="text-light">
					RecruitME v1.0<br>
					&copy; 2020 - <a class="text-light text-decoration-none" href="https://www.linkedin.com/in/mohabduls" target="__blank">Mohamad Abdul Sobur</a></small></strong>
			</div>
		</footer>
	</body>
</html>