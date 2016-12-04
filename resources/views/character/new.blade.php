@extends("layouts.page")

@section("content")

	<div class="content">
    	<h1>New Character</h1>

			<div class="col-lg-12">
				<form action="{!! url('character/new') !!}" method="POST">
					<div class="col-lg-6">

						<div class="form-group">
							<label for="name">Name</label>
							<input name="name" class="form-control" placeholder="Character Name" required/>
							@if ($errors->has('name'))
									<small class="help-inline text-danger">{{ $errors->first('name') }}</small>
							@endif
						</div>

						<div class="form-group">
							<label for="race">Race</label>
							<select class="form-control" name="race" required>
								<option value="" disabled selected> Please Select a Class</option>
								@foreach($races as $race)
									<option value="{!! $race["race_id"] !!}">{!! $race["name"] !!}</option>
								@endforeach
							</select>
							@if ($errors->has('race'))
								<small class="help-inline text-danger">{{ $errors->first('race') }}</small>
							@endif
						</div>

						<div class="form-group">
							<label for="class">Class</label>
							<select class="form-control" name="class" required>
								<option value="" disabled selected> Please Select a Class</option>
								@foreach($classes as $class)
									<option value="{!! $class["class_id"] !!}">{!! $class["name"] !!}</option>
								@endforeach
							</select>
							@if ($errors->has('class'))
									<small class="help-inline text-danger">{{ $errors->first('class') }}</small>
							@endif
						</div>

					</div>
					<div class="col-lg-6">
						<h1>Class description and skills</h1>
						<h1>Race description and skills</h1>
					<div>

					{!! csrf_field() !!}
					<button class="btn btn-success">Save Character</button>
			</form>
		</div>
	</div>
@endsection
