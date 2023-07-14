@extends('admin.layouts.base')

@section('page-title')
	<h1 class="m-0">CREATE NEW TECHNOLOGY</h1>
@endsection

@section('contents')
	<div class="wrapper w-50 mx-auto">

		<form method="POST" action="{{ route('admin.technologies.store') }}" novalidate>
			@csrf

			<div class="mb-3">
				<label for="name" class="form-label">Name</label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
					value="{{ old('name') }}">
				@error('name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<button class="btn btn-primary">Create</button>
		</form>
	</div>
@endsection
