<section class="space-y-6">
	<header>
		<h2>Delete Account</h2>
		<p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your
			account, please download any data or information that you wish to retain.</p>
	</header>

	<form method="POST" action="{{ route('admin.profile.destroy') }}">
		@csrf
		@method('delete')
		<div>
			<div>
				<label for="passwordDelete">Password</label>
				<input id="passwordDelete" name="password" type="password">
				@error('passwordDelete')
					{{ $message }}
				@enderror
			</div>

			<button class="btn btn-danger mt-2">Delete Account</button>
		</div>
	</form>
	{{--
	<!-- Modal -->
	<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="accountModalLabel">Delete Account</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					This account will be permanently deleted. Are you sure?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger">Yes</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div> --}}
</section>
