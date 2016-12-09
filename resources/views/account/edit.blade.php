@extends("layouts.account")

@section("content")
  <form role="form" action="{!! url('account/edit') !!}" method="POST">
    <div class="col-lg-12">
      <div class="col-lg-6">
        <h3>Personal Information</h3>
        <!-- first name -->
        <div class="form-group {!! $errors->has('first_name') ? 'has-error': '' !!}">
          {!! Form::label('first_name', 'First Name') !!}
          {!! Form::text('first_name', !empty(Input::old('first_name')) ? Input::old("first_name") : $user->first_name, array('class' => 'form-control',"required" => true)) !!}
          @if ($errors->has('first_name'))
            <small class="help-block text-danger">{!! $errors->first('first_name') !!}</small>
          @endif
        </div>

        <!-- last name -->
        <div class="form-group {!! $errors->has('last_name') ? 'has-error': '' !!}">
          {!! Form::label('last_name', 'Last Name') !!}
          {!! Form::text('last_name', !empty(Input::old('last_name')) ? Input::old("last_name") : $user->last_name, array('class' => 'form-control')) !!}
          @if ($errors->has('last_name'))
            <small class="help-block text-danger">{!! $errors->first('last_name') !!}</small>
          @endif
        </div>

      </div>
      <div class="col-lg-6">

        <h3>Login Information</h3>

          <!-- email -->
          <div class="form-group {!! $errors->has('email') ? 'has-error': '' !!}">
            {!! Form::label('email', 'Email Address') !!}
            {!! Form::email('email', !empty(Input::old('email')) ? Input::old("email") : $user->email, array('class' => 'form-control', "required" => true)) !!}
            @if ($errors->has('email'))
              <small class="help-block text-danger">{!! $errors->first('email') !!}</small>
            @endif
          </div>



          <div class="form-group {!! $errors->has('password') ? 'has-error': '' !!}">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', array('class' => 'form-control')) !!}
            @if ($errors->has('password'))
              <small class="help-block text-danger">{!! $errors->first('password') !!}</small>
            @endif
          </div>

          <!-- password confirmation -->
          <div class="form-group {!! $errors->has('confirm_password') ? 'has-error': '' !!}">
            {!! Form::label('confirm_password', 'Confirm Password') !!}
            {!! Form::password('confirm_password', array('class' => 'form-control')) !!}
            @if ($errors->has('confirm_password'))
              <small class="help-block text-danger">{!! $errors->first('confirm_password') !!}</small>
            @endif
          </div>
      </div>

      {!! csrf_field() !!}

      <div class="col-lg-12 title">
        <button type="submit" class="btn btn-success">Save Changes</button>
      </div>
    </div>

  </form>
@endSection
