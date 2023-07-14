<section class="space-y-6">
	<header>
		<h2>
			Delete Account
		</h2>

		<p>
			Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your
			account, please download any data or information that you wish to retain.
		</p>
	</header>

	<form method="post" action="{{ route('admin.profile.destroy') }}">
		@csrf
		@method('delete')

		<div class="mt-2">
			<label for="password_delete">Password</label>
			<input id="password_delete" name="password" type="password">
			@error('password')
				{{ $message }}
			@enderror
		</div>

		<button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#deleteAccount">Delete
			Account</button>
	</form>
</section>

{{-- Modal --}}
<div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteAccountLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				This Account will be deleted: are you sure?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger">Delete</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
