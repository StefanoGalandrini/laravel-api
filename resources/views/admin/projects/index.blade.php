@extends('admin.layouts.base')

@section('page-title')
	<h1 class="m-0">PROJECTS</h1>
@endsection

@section('contents')
	<div class="wrapper w-100 mx-auto">
		{{-- Messaggio di conferma cancellazione --}}
		@if (session('delete_success'))
			@php $project = session('delete_success') @endphp
			<div class="alert alert-warning">
				Project "{{ $project->title }}" has been deleted
			</div>
		@endif

		{{-- Trashed projects --}}
		<a href="{{ route('admin.projects.trashed') }}" class="btn btn-warning px-4 mb-3 fs-4"><i class="bi bi-trash3"></i>
			Trashed</a>
		{{-- Create new project --}}
		<a href="{{ route('admin.projects.create') }}" class="btn btn-info px-4 mb-3 fs-4"><i class="bi bi-file-earmark-plus"></i>
			Create </a>

		{{-- <h1>Projects</h1> --}}
		<div class="d-flex justify-content-center w-100">
			<table class="table table-bordered table-secondary table-striped table-hover table-rounded w-100">
				<thead>
					<tr class="thead-dark">
						<th>Title</th>
						<th>Type</th>
						<th>Image</th>
						<th>Technologies</th>
						<th>Creation Date</th>
						<th>Github URL</th>
						<th class="w-15">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($projects as $project)
						<tr>
							<td class="fw-bold fs-6">{{ $project->title }}</td>
							<td class="fw-bold fs-10">
								<a href="{{ route('admin.types.show', ['type' => $project->type]) }}">{{ $project->type->name }}
								</a>
							</td>
							<td><img class="img-thumbnail" src="{{ $project->url_image }}" alt="{{ $project->title }}" style="width: 150px;">
							</td>
							{{-- <td class="mt-4 fw-light fst-italic">{{ implode(', ', $project->technologies->pluck('name')->all()) }}</td> --}}
							<td class="mt-4 fw-light fst-italic">
								@foreach ($project->technologies as $technology)
									<a
										href="{{ route('admin.technologies.show', ['technology' => $technology]) }}">{{ $technology->name }}</a>{{ !$loop->last ? ', ' : '' }}
								@endforeach
							</td>
							{{-- {{ implode(', ', $project->technologies->pluck('name')->all()) }}</td> --}}
							<td>{{ \Carbon\Carbon::parse($project->creation_date)->format('d M Y') }}</td>
							<td><a href="{{ $project->github_url }}">{{ $project->url_repo }}</a></td>
							<td>
								<a href="{{ route('admin.projects.show', ['project' => $project]) }}"
									class="btn btn-success btn-sm fs-6">Show</a>
								<a href="{{ route('admin.projects.edit', ['project' => $project]) }}" class="btn btn-dark btn-sm fs-6">Edit</a>
								<button type="button" class="btn btn-danger btn-sm js-delete fs-6" data-resource="project"
									data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $project->slug }}">
									Delete
								</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>


			<!-- Modal -->
			<div class="modal fade text-dark" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Delete</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							Are you sure?
						</div>
						<div class="modal-footer">
							<form action="" data-template="{{ route('admin.projects.destroy', ['project' => '*****']) }}" method="post"
								class="d-inline-block" id="confirm-delete">
								@csrf
								@method('delete')
								<button class="btn btn-danger">Yes</button>
							</form>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{ $projects->links() }}
	</div>
@endsection
