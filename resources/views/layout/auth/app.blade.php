
<!doctype html>
<html lang="en">

<head>
	<title>Blog</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	<style>
    body {
        background-image: url("{{ asset('images/bg.jpg') }}");
    }
</style>

</head>

<body class="img js-fullheight">
    @yield('content')

	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/popper.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{('js/main.js')}}"></script>

</body>

</html>
