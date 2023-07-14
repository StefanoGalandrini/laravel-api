@extends('admin.layouts.base')

@section('page-title')
	<h1 class="m-0">TECHNOLOGY DETAILS</h1>
@endsection

@section('contents')
	@if (session('update_success'))
		@php $technology = session('update_success') @endphp
		<div class="alert alert-primary">
			Technology "{{ $technology->name }}" has been successfully updated
		</div>
	@endif

	@if (session('create_success'))
		@php $technology = session('create_success') @endphp
		<div class="alert alert-success">
			Technology "{{ $technology->name }}" has been successfully created
		</div>
	@endif

	<div class="card mx-auto rounded" style="width: 50vw">
		<div class="card-body">
			<span class="card-title fs-5 fw-bold">TECHNOLOGY: </span><span class="fs-4">{{ $technology->name }}</span>
			<h4>Projects using this Technology:</h4>
			<ul class="list-group list-group-flush">
				@foreach ($technology->projects as $project)
					<li class="list-group-item">
						<a href="{{ route('admin.projects.show', ['project' => $project]) }}">"{{ $project->title }}"</a><span> -
							({{ $project->creation_date }})
						</span>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@endsection
