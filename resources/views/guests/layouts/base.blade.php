<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Guest Base Login</title>
	@vite('resources/js/app.js')
</head>

<body>
	@include('guests.includes.header')

	<div class="container d-flex align-items-center justify-content-center mt-5 mb-5 p-5 rounded border"
		style="width: 30vw;">
		<main>
			@yield('contents')
		</main>
	</div>


	@include('guests.includes.footer')
</body>

</html>
