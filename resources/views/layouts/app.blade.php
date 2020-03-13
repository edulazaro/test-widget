<html lang="{{ app()->getLocale() }}">
<head>
	<title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Scripts -->
	<script type="text/javascript" src="js/app.js"></script>
	@stack('scripts')

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/app.css">
</head>
<body>
	<div class="flex-center position-ref full-height">
		<div id="content">
        @yield('content')
		</div>
	</div>	
</body>
</html>