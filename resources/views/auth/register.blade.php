@extends("layouts.auth")

@section("content")
	<div class="col-lg-12">
		<form role="form" action="{!! url('auth/register') !!}" method="POST">


			<h3>Sign Up</h3>
			<div class="col-lg-12">
				<h3>Personal Information</h3>
				<div class="col-lg-6">
					<!-- first name -->
					<div class="form-group {!! $errors->has('first_name') ? 'has-error': '' !!}">
						{!! Form::label('first_name', 'First Name') !!}
						{!! Form::text('first_name', Input::old('first_name'), array('class' => 'form-control',"required" => true)) !!}
						@if ($errors->has('first_name'))
						<small class="help-block text-danger">{!! $errors->first('first_name') !!}</small>
						@endif
					</div>

					<!-- last name -->
					<div class="form-group {!! $errors->has('last_name') ? 'has-error': '' !!}">
						{!! Form::label('last_name', 'Last Name') !!}
						{!! Form::text('last_name', Input::old('last_name'), array('class' => 'form-control',"required" => true)) !!}
						@if ($errors->has('last_name'))
						<small class="help-block text-danger">{!! $errors->first('last_name') !!}</small>
						@endif
					</div>

					<!-- Phone -->
					<div class="form-group {!! $errors->has('phone') ? 'has-error': '' !!}">
						{!! Form::label('phone', 'Phone') !!}
						{!! Form::text('phone', Input::old('phone'), array('class' => 'form-control',"required" => false)) !!}
						@if ($errors->has('phone'))
						<small class="help-block text-danger">{!! $errors->first('phone') !!}</small>
						@endif
					</div>
					<!-- Address 1 -->
					<div class="form-group {!! $errors->has('address_1') ? 'has-error': '' !!}">
						{!! Form::label('address_1', 'Address 1') !!}
						{!! Form::text('address_1', Input::old('address_1'), array('class' => 'form-control',"required" => true)) !!}
						@if ($errors->has('address_1'))
						<small class="help-block text-danger">{!! $errors->first('address_1') !!}</small>
						@endif
					</div>

					<!-- Address 2 -->
					<div class="form-group {!! $errors->has('address_2') ? 'has-error': '' !!}">
						{!! Form::label('address_2', 'Address 2') !!}
						{!! Form::text('address_2', Input::old('address_2'), array('class' => 'form-control',"required" => true)) !!}
						@if ($errors->has('address_2'))
						<small class="help-block text-danger">{!! $errors->first('address_2') !!}</small>
						@endif
					</div>

				</div>
				<div class="col-lg-6">

					<!-- Country -->
					<div class="form-group {!! $errors->has('country') ? 'has-error': '' !!}">
						{!! Form::label('country', 'Country') !!}
						@include('layouts.partials.countries', array("name" => "country", "id" => "country", "class" => "form-control", "required" => true))
						@if ($errors->has('country'))
						<small class="help-block text-danger">{!! $errors->first('country') !!}</small>
						@endif
					</div>

					<!-- state -->
		      <div class="states" id="states">
		        <div class="form-group {!! $errors->has('state') ? 'has-error': '' !!}">
		          {!! Form::label('state', 'State') !!}
		          @include('layouts.partials.states', array("name" => "state","id" => "state", "class" => "form-control", "required" => true))
		        </div>
		      </div>

					<!-- City -->
					<div class="form-group {!! $errors->has('city') ? 'has-error': '' !!}">
						{!! Form::label('city', 'City') !!}
						{!! Form::text('city', Input::old('city'), array('class' => 'form-control',"required" => true)) !!}
						@if ($errors->has('city'))
						<small class="help-block text-danger">{!! $errors->first('city') !!}</small>
						@endif
					</div>

					<!-- Zip Code -->
					<div class="form-group {!! $errors->has('zip') ? 'has-error': '' !!}">
						{!! Form::label('zip', 'Zip Code') !!}
						{!! Form::text('zip', Input::old('zip'), array('class' => 'form-control',"required" => true)) !!}
						@if ($errors->has('zip'))
							<small class="help-block text-danger">{!! $errors->first('zip') !!}</small>
						@endif
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<h3>Login Information</h3>
				<div class="col-lg-6">
					<!-- email -->
					<div class="form-group {!! $errors->has('email') ? 'has-error': '' !!}">
						{!! Form::label('email', 'Email Address') !!}
						{!! Form::email('email', Input::old('email'), array('class' => 'form-control', "required" => true)) !!}
						@if ($errors->has('email'))
							<small class="help-block text-danger">{!! $errors->first('email') !!}</small>
						@endif
					</div>

					<!-- email confirmation -->
					<div class="form-group {!! $errors->has('confirm_email') ? 'has-error': '' !!}">
						{!! Form::label('confirm_email', 'Confirm Email') !!}
						{!! Form::email('confirm_email', '', array('class' => 'form-control', "required" => true)) !!}
						@if ($errors->has('confirm_email'))
							<small class="help-block text-danger">{!! $errors->first('confirm_email') !!}</small>
						@endif
					</div>

				</div>
				<div class="col-lg-6">

					<!-- password -->
					<div class="form-group {!! $errors->has('password') ? 'has-error': '' !!}">
						{!! Form::label('password', 'Password') !!}
						{!! Form::password('password', array('id' =>'myPassword','class' => 'form-control', "required" => true)) !!}
						@if ($errors->has('password'))
							<small class="help-block text-danger">{!! $errors->first('password') !!}</small>
						@endif
					</div>

					<!-- password confirmation -->
					<div class="form-group {!! $errors->has('confirm_password') ? 'has-error': '' !!}">
						{!! Form::label('confirm_password', 'Confirm Password') !!}
						{!! Form::password('confirm_password', array('class' => 'form-control', "required" => true)) !!}
						@if ($errors->has('confirm_password'))
							<small class="help-block text-danger">{!! $errors->first('confirm_password') !!}</small>
						@endif
					</div>
				</div>
			</div>

			{!! csrf_field() !!}

			<div class="col-lg-12 title">
				<button type="submit" class="btn btn-success">Create Account</button>
			</div>

		</form>
		<script>
			$(document).ready(function($) {
				$("#country").change(function(){
					if( $("#country").val() === "US" ) $("#state").show();
					else $("#state").hide();
				});

				$("#state").val("{!! Input::old('state') !!}");
				$("#country").val("{!! Input::old('country') !!}");

				if( $("#country").val() === "US" ) $("#state").show();
				else $("#state").hide();

				// $('#myPassword').strength({
        //   strengthClass: 'strength',
        //   strengthMeterClass: 'strength_meter',
        //   strengthButtonClass: 'button_strength',
        //   strengthButtonText: 'Show Password',
        //   strengthButtonTextToggle: 'Hide Password'
				// });

			});
		</script>
	</div>
@endsection
