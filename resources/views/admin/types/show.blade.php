@extends('admin.layouts.base')

@section('page-title')
	<h1 class="m-0">TYPE DETAILS</h1>
@endsection

@section('contents')
	@if (session('update_success'))
		@php $project = session('update_success') @endphp
		<div class="alert alert-success">
			Type "{{ $type->name }}" has been successfully updated
		</div>
	@endif

	<div class="card mx-auto rounded" style="width: 50vw">
		<div class="card-body">
			<h2 class="card-title">Type: <span class="fst-italic text-uppercase"> "{{ $type->name }}"</span></h2>
			<p class="card-text mt-5">Description:</p>
			<p>{{ $type->description }}</p>
			<h3>Projects of this Type:</h3>
			<ul class="list-group list-group-flush">
				@foreach ($type->projects as $project)
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
