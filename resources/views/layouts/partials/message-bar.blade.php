<div class="messages">
	@if( Session::has('success_message') )
		<p class="alert alert-success session-message">
			{!! Session::get("success_message") !!}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
		</p>
	@elseif( Session::has('warning_message') )
		<p class="alert alert-warning session-message">
			{!! Session::get("warning_message") !!}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
		</p>
	@elseif( Session::has('error_message') )
		<p class="alert alert-danger session-message">
			{!! Session::get("error_message") !!}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
		</p>
	@endif
</div>
