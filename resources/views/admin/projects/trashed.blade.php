@extends('admin.layouts.base')

@section('page-title')
	<h1 class="m-0">TRASHED PROJECTS</h1>
@endsection

@section('contents')
	<div class="wrapper w-100 mx-auto">
		{{-- Messaggio di conferma cancellazione --}}
		@if (session('delete_success'))
			@php $project = session('delete_success') @endphp
			<div class="alert alert-warning">
				Project "{{ $project->title }}" has been permanently deleted
			</div>
		@endif

		{{-- Messaggio di conferma Restore --}}
		@if (session('restore_success'))
			@php $project = session('restore_success') @endphp
			<div class="alert alert-success">
				Project "{{ $project->title }}" has been restored
			</div>
		@endif
		{{-- Back to Index --}}
		<a href="{{ route('admin.projects.index') }}" class="btn btn-primary px-4 mb-3 fs-4"><i class="bi bi-card-list"></i>
			Index</a>

		{{-- <h1>Projects</h1> --}}
		<div class="d-flex justify-content-center w-100">
			<table class="table table-bordered table-secondary table-striped table-hover table-rounded w-100">
				<thead>
					<tr class="thead-dark">
						<th>Title</th>
						<th>Type</th>
						<th>Image</th>
						<th class="w-25">Technologies</th>
						<th>Creation Date</th>
						<th class="w-15">Github URL</th>
						<th>Actions</th>
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
							<td><img class="img-thumbnail" src="{{ $project->url_image }}" alt="{{ $project->title }}" style="width: 120px;">
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
								<!-- Restore Button -->
								<form action="{{ route('admin.projects.restore', ['slug' => $project->slug]) }}" method="post"
									class="d-inline-block">
									@csrf
									<button type="submit" class="btn btn-primary btn-sm fs-6">
										Restore
									</button>
								</form>

								<!-- Destroy Button with Modal -->
								<button type="button" class="btn btn-danger btn-sm js-delete fs-6" data-resource="project"
									data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $project->slug }}">
									Destroy
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
							This project will be lost: Are you sure?
						</div>
						<div class="modal-footer">
							<form action="" data-template="{{ route('admin.projects.forcedelete', ['slug' => '*****']) }}"
								method="post" class="d-inline-block" id="confirm-delete">
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
