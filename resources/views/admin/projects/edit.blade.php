@extends('admin.layouts.base')

@section('page-title')
	<h1 class="m-0">EDIT PROJECT</h1>
@endsection

@section('contents')
	<div class="wrapper w-50 mx-auto">

		<form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" novalidate>
			@csrf
			@method('PUT')

			<div class="mb-3">
				<label for="title" class="form-label">Title</label>
				<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
					value="{{ old('title', $project->title) }}">
				@error('title')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			{{-- Upload image --}}
			<p class="mb-2">Load an image</p>
			<div class="input-group mb-3">
				<input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
					accept="image/*">
				<label class="input-group-text" for="image">Upload</label>
				@error('image')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			{{-- Add input select for types of projects --}}
			<div class="mb-3">
				<label for="type" class="form-label">Type</label>
				<select class="form-select @error('type_id') is-invalid @enderror" id="type" name="type_id">
					@foreach ($types as $type)
						<option value="{{ $type->id }}" @if ((int) old('type_id', $project->type->id) === $type->id) selected @endif>{{ $type->name }}
						</option>
					@endforeach
				</select>
				@error('type_id')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			{{-- Add checkboxes for project technologies --}}
			<div class="mb-3">
				<h4 class="fw-bold">Technologies:</h4>
				@foreach ($technologies as $tech)
					<div class="mb-3 form-check form-check-inline">
						<input type="checkbox" class="form-check-input" id="tech{{ $tech->id }}" value="{{ $tech->id }}"
							name="technologies[]" @if (in_array($tech->id, old('technologies', $project->technologies->pluck('id')->all()))) checked @endif>
						<label class="form-check-label" for="tech{{ $tech->id }}">{{ $tech->name }}</label>
					</div>
				@endforeach
			</div>

			<div class="mb-3">
				<label for="url_image" class="form-label">URL Image</label>
				<input type="url" class="form-control @error('url_image') is-invalid @enderror" id="url_image" name="url_image"
					value="{{ old('url_image', $project->url_image) }}">
				@error('url_image')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="mb-3">
				<label for="description" class="form-label">Description</label>
				<textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
				 name="description">{{ old('description', $project->description) }}</textarea>
				@error('description')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="mb-3">
				<label for="creation_date"" class="form-label">Creation Date</label>
				<input type="date" class="form-control @error('creation_date') is-invalid @enderror" id="creation_date"
					name="creation_date"" value="{{ old('creation_date', $project->creation_date) }}">
				@error('creation_date')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

			<div class="mb-3">
				<label for="url_repo" class="form-label">URL repo</label>
				<input type="url" class="form-control @error('url_repo') is-invalid @enderror" id="url_repo" name="url_repo"
					value="{{ old('url_repo', $project->url_repo) }}">
				@error('url_repo')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>


			<button class="btn btn-success px-5 mt-3 fs-4"><i class="bi bi-pencil-square"></i> Edit</button>
			<a href="{{ route('admin.projects.index') }}" class="btn btn-secondary fs-4 ms-4 mt-3"><i
					class="bi bi-backspace"></i> Cancel</a>
		</form>
	</div>
@endsection
