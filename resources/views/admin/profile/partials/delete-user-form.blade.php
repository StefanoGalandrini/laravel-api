<section class="mb-4">
	<header class="mb-4">
		<h2 class="display-4 text-dark">Delete Account</h2>

		<p class="text-muted">
			Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your
			account, please download any data or information that you wish to retain.
		</p>
	</header>

	<!-- Button trigger modal -->
	<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
		Delete Account
	</button>

	<!-- Modal -->
	<div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="{{ route('admin.profile.destroy') }}" class="p-3">
					@csrf
					@method('delete')

					<div class="modal-header">
						<h5 class="modal-title" id="confirmUserDeletionModalLabel">Are you sure you want to delete your account?</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">
						<p class="text-muted">
							Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your
							password
							to confirm you would like to permanently delete your account.
						</p>

						<div class="mt-3">
							<label for="password" class="form-label sr-only">Password</label>
							<input id="password" name="password" type="password" class="form-control" placeholder="Password">

							<x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-danger">Delete Account</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
