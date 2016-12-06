@extends("layouts.page")

@section("content")

	<div class="content">
    	<h1>New Game</h1>
      	<form action="{!! url('games/new') !!}" method="POST">
					<div class="col-lg-6">

						<div class="form-group">
							<label for="name">Name</label>
							<input name="name" class="form-control" placeholder="Game Name" required/>
							@if ($errors->has('name'))
									<small class="help-inline text-danger">{{ $errors->first('name') }}</small>
							@endif
						</div>

						<div class="form-group">
							<label for="players"></label>
							<select class="form-control" name="players" required>
								<option value="" disabled selected> Please Select a Player</option>
								@foreach($user as $user)
									<option value="{!! $user["user_id"] !!}">{!! $user->getName() !!}</option>
								@endforeach
							</select>
							@if ($errors->has('players'))
								<small class="help-inline text-danger">{{ $errors->first('players') }}</small>
							@endif
						</div>

						<div class="form-group">
							<label for="gm">Class</label>
							<select class="form-control" name="gm" required>
								<option value="" disabled selected> Please Select a GM</option>
								@foreach($users as $user)
									<option value="{!! $user["user_id"] !!}">{!! $user->getName() !!}</option>
								@endforeach
							</select>
							@if ($errors->has('gm'))
									<small class="help-inline text-danger">{{ $errors->first('gm') }}</small>
							@endif
						</div>

					</div>
					<div class="col-lg-6">
						<h1>Game Players</h1>
            <ul>
              
            </ul>
					<div>

					{!! csrf_field() !!}
					<button class="btn btn-success">Save Game</button>
			</form>
	</div>
@endsection
