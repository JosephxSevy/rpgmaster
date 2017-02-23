@extends("layouts.page")

@section("content")

	<div class="content">
    	<h1>Edit Character</h1>

			<div class="col-lg-12">
				<form action="{!! url('character/edit') !!}" method="POST">
					<div class="col-lg-6">
						<h3>Info</h3>

						<div class="form-group">
							<label for="name">Name</label>
							<input value="{!! $character['name'] !!}" name="name" class="form-control" placeholder="Character Name" required/>
							@if ($errors->has('name'))
									<small class="help-inline text-danger">{!! $errors->first('name') !!}</small>
							@endif
						</div>

						<div class="form-group">
							<label for="race">Race</label>
							<select class="form-control" id="race" name="race" required>
								<option value="" disabled selected>Please Select a Race</option>
								@foreach($races as $race)
									<option value="{!! $race["race_id"] !!}" {!! ($character['race'] == $race["race_id"]) ? "selected" : "" !!}>{!! $race["name"] !!}</option>
								@endforeach
							</select>
							@if ($errors->has('race'))
								<small class="help-inline text-danger">{!! $errors->first('race') !!}</small>
							@endif
						</div>

						<div class="form-group" id="race_skill_div">
							<label for="race_skill">Race Skill</label>
							<select name="race_skill" class="form-control" id="race_skill">
								<option value="" disabled selected> Please Select a Race first</option>
							</select>
							@if ($errors->has('race_skill'))
									<small class="help-inline text-danger">{!! $errors->first('race_skill') !!}</small>
							@endif
						</div>

						<div class="form-group">
							<label for="class">Class</label>
							<select class="form-control" id="class" name="class" required>
								<option value="" disabled selected>Please Select a Class</option>
								@foreach($classes as $class)
									<option value="{!! $class["class_id"] !!}"  {!! ($character["race"] == $class["class_id"]) ? "selected" : "" !!} >{!! $class["name"] !!}</option>
								@endforeach
							</select>
							@if ($errors->has('class'))
									<small class="help-inline text-danger">{!! $errors->first('class') !!}</small>
							@endif
						</div>

						<div class="form-group" id="class_skill_div">
							<label for="class_skill">Class Skill</label>
							<select name="class_skill" class="form-control" id="class_skill">
								<option value="" disabled selected> Please Select a Class first</option>
							</select>
							@if ($errors->has('class_skill'))
									<small class="help-inline text-danger">{!! $errors->first('class_skill') !!}</small>
							@endif
						</div>

					</div>
					<div class="col-lg-6">
						<h3>Stats</h3>
						<span>Stats can be distributed as you wish, but you can only have a net gain of 2</span>
						<table class="table table-stripped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Strength</td>
									<td> <input class="form-control" type="number" name="strength" id="strength" value="{!! $character["stats"]["strength"] !!}"> </td>
								</tr>
								<tr>
									<td>Dexterity</td>
									<td> <input class="form-control" type="number" name="dexterity" id="dexterity" value="{!! $character["stats"]["dexterity"] !!}"> </td>
								</tr>
								<tr>
									<td>Charisma</td>
									<td> <input class="form-control" type="number" name="charisma" id="charisma" value="{!! $character["stats"]["charisma"] !!}"> </td>
								</tr>
								<tr>
									<td>Intelligence</td>
									<td> <input class="form-control" type="number" name="intelligence" id="intelligence" value="{!! $character["stats"]["intelligence"] !!}"> </td>
								</tr>
								<tr>
									<td>Wisdom</td>
									<td> <input class="form-control" type="number" name="wisdom" id="wisdom" value="{!! $character["stats"]["wisdom"] !!}"> </td>
								</tr>
								<tr>
									<td>Constitution</td>
									<td> <input class="form-control" type="number" name="constitution" id="constitution" value="{!! $character["stats"]["constitution"] !!}"> </td>
								</tr>
							</tbody>
						</table>
						@if ($errors->has('stats'))
								<small stats="help-inline text-danger">{!! $errors->first('stats') !!}</small>
						@endif
					</div>

					{!! csrf_field() !!}
					<div class="col-lg-12">
						<button class="btn btn-success">Save Character</button>
					</div>
			</form>
		</div>
	</div>
	<script>
		$(document).ready( function() {


			var race_list = {!! json_encode($races) !!};
			var class_list = {!! json_encode($classes) !!};

			var races = [];
			$.each(race_list, function(index, val) {

				var race = {
					name : val.name,
					race_id : val.race_id,
					stats : val.stats
				};

				skills = [];
				$.each(val.skills, function(i, v) {
					var skill = {
						name : v.name,
						skill_id : v.skill_id
					};
					skills.push( skill );
				});

				race.skills = skills;
				races[val.race_id] = race;

			});

			var clses = [];
			$.each(class_list, function(index, val) {

				var cls = {
					name : val.name,
					cls_id : val.class_id
				};

				skills = [];
				$.each(val.skills, function(i, v) {
					var skill = {
						name : v.name,
						skill_id : v.skill_id
					};
					skills.push( skill );
				});

				cls.skills = skills;
				clses[val.class_id] = cls;

			});


			$("#race").change( function() {
				var id	 = $(this).val();
				var chosen_race = races[id];

				var html = "<option value='empty' disabled selected>Please select a skill</option>";
				$.each(chosen_race.skills, function(index, skill) {
					html += "<option value='" + skill.skill_id + "'>" + skill.name + "</option>"
				});

				$("#strength").val( chosen_race.stats["strength"] );
				$("#dexterity").val( chosen_race.stats["dexterity"] );
				$("#charisma").val( chosen_race.stats["charisma"] );
				$("#intelligence").val( chosen_race.stats["intelligence"] );
				$("#wisdom").val( chosen_race.stats["wisdom"] );
				$("#constitution").val( chosen_race.stats["constitution"] );


				$("#race_skill").html(html);

			});

			$("#class").change( function() {
				var id	 = $(this).val();
				var chosen_class = clses[id];
				console.log(chosen_class);

				var html = "<option value='empty' disabled selected>Please select a skill</option>";
				$.each(chosen_class.skills, function(index, skill) {
					html += "<option value='" + skill.skill_id + "'>" + skill.name + "</option>"
				});

				$("#class_skill").html(html);
				$
			});

		});
	</script>
@endsection
