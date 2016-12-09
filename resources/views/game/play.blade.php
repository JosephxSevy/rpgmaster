@extends("layouts.page")

@section("content")

	@if( User::isGM($game->game_id) )
		<div class="content">
	      <div class="col-lg-12">
	      	<div class="col-lg-6">
						<h2>Story</h2>
						<div style="overflow-y: auto; height: 100%;">
							@foreach($game->actions as $action)
								<h4>{!! User::getMyName($action["user_id"]) !!}</h4>
								<p>
									{!! $action["action"] !!}
								</p>
							@endforeach
						</div>
					</div>
					<div class="col-lg-6">
						<select name="users">
							{{-- @foreach($users as $user)
								<option></option>
							@endforeach --}}
						</select>
					</div>
				</div>
		</div>
	@else
		<div class="content">
	      <div class="col-lg-12">
	      	<div class="col-lg-6">
						<h2>Story</h2>
						<div style="overflow-y: auto; height: 100%;">
							@foreach($game->actions as $action)
								<h4>{!! User::getMyName($action["user_id"]) !!}</h4>
								<p>
									{!! $action["action"] !!}
								</p>
							@endforeach
						</div>
					</div>
					<div class="col-lg-6">
						<form id="move" method="POST">
							<h3>Action</h3>
							<textarea name="action" class="form-control" required></textarea>
							@if ($errors->has('action'))
									<small class="help-inline text-danger">{{ $errors->first('action') }}</small>
							@endif
							{!! csrf_field() !!}
							<input type="hidden" name="slug" value="{!! Input::get("slug") !!}">
							<button class="btn btn-success">Submit Move</button>
						</form>
					</div>
				</div>
		</div>
	@endif

@endsection
