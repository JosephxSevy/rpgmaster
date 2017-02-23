@extends("layouts.page")

@section("content")

	@if( User::isGM($game->game_id) )

		<div class="content">
	      <div class="col-lg-12">
	      	<div class="col-lg-6">
						<h2>Story</h2>
						<div style="overflow-y: auto; height: 100%;">
							@foreach($game->getActions() as $index => $action)
								@if($action["user_id"] == $game->gm)
									<h4>(Dungeon Master) {!! User::getMyName($action["user_id"]) !!}</h4>
								@else
									<h4>{!! User::getMyName($action["user_id"]) !!}</h4>
								@endif
								@if( !empty($action["roll_dice"]) && $action["roll_dice"] )
									@if(Sentry::getUser()->user_id == $action["allowed_user"])
										<form id="rolling" action="{!! url('game/play') !!}" method="POST">
											<button name="roll" type="submit"class="btn btn-success">Roll the Dice!</button>
											<input type="hidden" name="dice" value="{!! Input::get("dice") !!}">
											<input type="hidden" name="slug" value="{!! Input::get("slug") !!}">
											{!! csrf_field() !!}
											<input type="hidden" name="action-number" value="{!! $index !!}">
										</form>
									@else
										<font color="red">{!! User::getMyName($action["allowed_user"])!!}</font>: Is rolling the dice
									@endif
								@else
									<p>{!! $action["action"] !!}</p>
								@endif
							@endforeach
						</div>
					</div>
					<div class="col-lg-6">
						<form id="move" action="{!! url('game/play') !!}" method="POST">
							<h3>Action</h3>
							<textarea name="action" class="form-control" required></textarea>
							@if ($errors->has('action'))
									<small class="help-inline text-danger">{!! $errors->first('action') !!}</small>
							@endif
							{!! csrf_field() !!}
							<input type="hidden" name="slug" value="{!! Input::get("slug") !!}">
							<button name="move" type="submit"class="btn btn-success">Submit Move</button>
						</form>

						<div class="col-lg-3">
							<form id="action-roll" action="{!! url('game/play') !!}" method="POST">
								<label for="players">Players</label>
								<select name="player" class="form-control" id="players">
									<option value="" disabled selected> Please Select a Player</option>
									@foreach($game->getPlayers() as $player)
										<option name="player" value="{!! $player !!}">{!! User::getMyName($player) !!}</option>
									@endforeach
								</select>
								@if ($errors->has('players'))
									<small class="help-inline text-danger">{!! $errors->first('players') !!}</small>
								@endif

								<label for="users">Roll</label>
								<select name="dice" class="form-control" id="dice">
									<option value="" disabled selected> Please Select Dice</option>
									@foreach($game->getDice() as $dice)
										<option name="dice" value="{!! $dice !!}">{!! "D" . $dice !!}</option>
									@endforeach
								</select>
								@if ($errors->has('dice'))
									<small class="help-inline text-danger">{!! $errors->first('dice') !!}</small>
								@endif
								{!! csrf_field() !!}
								<input type="hidden" name="slug" value="{!! Input::get("slug") !!}">
								<button name="action-roll" type="submit" class="btn btn-success">Submit</button>
							</form>
						</div>
					</div>
				</div>
		</div>
	@else

		<div class="content">
	      <div class="col-lg-12">
	      	<div class="col-lg-6">
						<h2>Story</h2>
						<div style="overflow-y: auto; height: 100%;">
								@foreach($game->actions as $index => $action)
									@if($action["user_id"] == $game->gm)
										<h4>(Dungeon Master) {!! User::getMyName($action["user_id"]) !!}</h4>
									@else
										<h4>{!! User::getMyName($action["user_id"]) !!}</h4>
									@endif
									@if( !empty($action["roll_dice"]) && $action["roll_dice"] )
										@if(Sentry::getUser()->user_id == $action["allowed_user"])
											<form id="rolling" action="{!! url('game/play') !!}" method="POST">
												<button name="roll" type="submit"class="btn btn-success">Roll the Dice!</button>
												<input type="hidden" name="dice" value="{!! $action["dice"] !!}">
												<input type="hidden" name="slug" value="{!! Input::get("slug") !!}">
												{!! csrf_field() !!}
												<input type="hidden" name="action-number" value="{!! $index !!}">
											</form>
										@else
											<font color="red">{!! User::getMyName($action["allowed_user"])!!}</font>: Is rolling the dice
										@endif
									@else
										<p>{!! $action["action"] !!}</p>
									@endif
							@endforeach
						</div>
					</div>
					<div class="col-lg-6">
						<form id="move" action="{!! url('game/play') !!}" method="POST">
							<h3>Action</h3>
							<textarea name="action" class="form-control" required></textarea>
							@if ($errors->has('action'))
									<small class="help-inline text-danger">{!! $errors->first('action') !!}</small>
							@endif
							{!! csrf_field() !!}
							<input type="hidden" name="slug" value="{!! Input::get("slug") !!}">
							<button name="move" type="submit" class="btn btn-success">Submit Move</button>
						</form>
					</div>
				</div>
		</div>
	@endif

@endsection
