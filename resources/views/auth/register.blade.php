@extends('guests.layouts.base')

@section('contents')
	<div class="wrapper" style="width: 30vw;">
		<form method="post" action="{{ route('register') }}" class="p-5">
			@csrf

			{{-- Name --}}
			<div class="mb-3">
				<label for="name" class="form-label">Name</label>
				<input type="text" class="form-control" id="name" name="name" required autofocus autocomplete="name"
					value="{{ old('name') }}">
			</div>

			{{-- Email Address --}}
			<div class="mb-3">
				<label for="email" class="form-label">Email</label>
				<input type="email" class="form-control" id="email" name="email" required autofocus autocomplete="username"
					value="{{ old('email') }}">
			</div>

			{{-- Password --}}
			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
			</div>

			{{-- Confirm Password --}}
			<div class="mb-3">
				<label for="password_confirmation" class="form-label">Confirm Password</label>
				<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required
					autocomplete="new-password">
			</div>

			<a href="{{ route('login') }}">
				Already registered?
			</a>

			<button type="submit" class="btn btn-secondary ms-3">Register</button>
		</form>
	</div>
@endsection
