@extends('admin.layouts.base')

@section('page-title')
	<h1 class="m-0">TECHNOLOGIES</h1>
@endsection

@section('contents')
	<div class="wrapper w-50 mx-auto">
		{{-- Messaggio di conferma cancellazione --}}
		@if (session('delete_success'))
			@php $technology = session('delete_success') @endphp
			<div class="alert alert-danger">
				Technology "{{ $technology->name }}" has been deleted.
			</div>
		@endif

		<div class="d-flex justify-content-center">
			<table class="table table-bordered table-secondary table-striped table-hover table-rounded">
				<thead>
					<tr class="thead-dark">
						<th>ID</th>
						<th>Name</th>
						<th>Project Count</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($technologies as $technology)
						<tr>
							<td class="fs-10">{{ $technology->id }}</td>
							<td class="fs-8">{{ $technology->name }}</td>
							<td class="fs-8">{{ $technology->projects->count() }}</td>
							<td>
								<a href="{{ route('admin.technologies.show', ['technology' => $technology]) }}"
									class="btn btn-success btn-sm">Show</a>
								<a href="{{ route('admin.technologies.edit', ['technology' => $technology]) }}"
									class="btn btn-primary btn-sm">Edit</a>
								<button type="button" class="btn btn-danger btn-sm js-delete" data-resource="technology" data-bs-toggle="modal"
									data-bs-target="#deleteModal" data-id="{{ $technology->id }}">
									Delete
								</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<!-- Modal -->
			<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							Are you sure?
						</div>
						<div class="modal-footer">
							<form action="" data-template="{{ route('admin.technologies.destroy', ['technology' => '*****']) }}"
								method="post" class="d-inline-block" id="confirm-delete">
								@csrf
								@method('delete')
								<button class="btn btn-danger">Yes</button>
							</form>
							<button type="button" class="btn btn-secondary">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{ $technologies->links() }}
	</div>
@endsection
