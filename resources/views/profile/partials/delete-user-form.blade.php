<section class="space-y-6">
	<header>
		<h2>Delete Account</h2>
		<p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your
			account, please download any data or information that you wish to retain.</p>
	</header>

	<button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#deleteAccount">Delete Account</button>
</section>

<div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="deleteAccountLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteAccountLabel">Are you sure?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{ route('admin.profile.destroy') }}">
				@csrf
				@method('delete')
				<div class="modal-body">
					<p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your
						password to confirm.</p>
					<div class="form-group">
						<label for="password_delete">Password</label>
						<input id="password_delete" name="password" type="password" class="form-control">
						@error('password')
							<small class="text-danger">{{ $message }}</small>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>
