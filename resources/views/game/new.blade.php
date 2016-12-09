@extends("layouts.page")

@section("content")

	<div class="content">
    	<h1>New Game</h1>
      	<form action="{!! url('game/new') !!}" method="POST">
					<div class="col-lg-6">

						<div class="form-group">
							<label for="name">Name</label>
							<input name="name" class="form-control" placeholder="Game Name" required/>
							@if ($errors->has('name'))
									<small class="help-inline text-danger">{{ $errors->first('name') }}</small>
							@endif
						</div>

						<div class="form-group">
							<label for="users">Users</label>
							<select class="form-control" id="users">
								<option value="" disabled selected> Please Select a Player</option>
								@foreach($users as $user)
									<option value="{!! $user["user_id"] !!}">{!! $user->getName() !!}</option>
								@endforeach
							</select>
							@if ($errors->has('players'))
								<small class="help-inline text-danger">{{ $errors->first('players') }}</small>
							@endif
						</div>

					</div>
					<div class="col-lg-6">
						<table class="table table-stripped">
							<thead>
								<tr>
									<th>Name</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="player_list">
							</tbody>
						</table>
					</div>

					{!! csrf_field() !!}
					<button class="btn btn-success">Save Game</button>
			</form>
	</div>
	<script>
	$("#users").change( function(){
		var name = $(this).find(":selected").text();
		var id	 = $(this).val();
		$("#player_list").append("<tr><><td>" + name + "<input type='hidden' name='players[]' value='" + id + "'></td><td><span id='remove' class='glyphicon glyphicon-remove'></span></td></tr>");
	});
	$(document).on("click", "#remove", function(){
		$(this).parent().parent().remove();
	});
	</script>
@endsection
