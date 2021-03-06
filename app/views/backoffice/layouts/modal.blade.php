<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">{{ $modalTitle }}</h4>
			</div>
			<div class="modal-body">
				{{ $modalBody }}
			</div>
			<div class="modal-footer">
				{{ $modalFooter}}
			</div>
		</div>
	</div>
</div>