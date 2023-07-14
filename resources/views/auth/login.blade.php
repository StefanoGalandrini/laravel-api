@extends('guests.layouts.base')

@section('contents')
	<div class="wrapper" style="width: 30vw;">
		<form method="POST" action="{{ route('login') }}" class="p-5">
			@csrf

			{{-- Email Address --}}
			<div class="mb-3">
				<label for="email" class="form-label">Email</label>
				<input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required
					autofocus autocomplete="username" value="{{ old('email') }}">
			</div>

			{{-- Password --}}
			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
			</div>

			{{-- Checkbox Remember Me --}}
			<div class="mb-3 form-check">
				<input type="checkbox" class="form-check-input" id="remember" name="remember">
				<label class="form-check-label" for="remember">Remember me</label>
			</div>

			<a href="{{ route('password.request') }}">Forgot your password?</a>

			<button type="submit" class="btn btn-secondary ms-3">Login</button>
		</form>
	</div>
@endsection
