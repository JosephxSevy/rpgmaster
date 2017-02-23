@extends("layouts.auth")

@section("content")
  <form role="form" id="login-form" action="{!! url("auth/login") !!}" method="POST">
      <div class="col-lg-6">
          <div class="col-lg-8 col-lg-offset-2">
            <h3>Sign In</h3>
            <div class="form-group {!! $errors->has('email') ? 'has-error': '' !!}">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'name@example.com', 'required' => '')) !!}
                @if ($errors->has('email'))
                    <small class="help-inline text-danger">{!! $errors->first('email') !!}</small>
                @endif
            </div>

            <div class="form-group {!! $errors->has('password') ? 'has-error': '' !!} " >
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', array('class' => 'form-control', 'requried' => '')) !!}
                @if ($errors->has('password'))
                    <small class="help-inline text-danger">{!! $errors->first('password') !!}</small>
                @endif
            </div>

            {!!-- <div class="form-group col-desktop-12">
                {!! Form::checkbox('remember_me', 'remember_me', Input::has('remember_me')) !!}
                {!! Form::label('remember_me', 'Remember Me') !!}
                <br />
            </div> --!!}

          </div>
          <div class="col-lg-12 title">
            <button type="submit" class="btn btn-success">Login</button>
          </div>
      </div>

      <div class="col-lg-6">
        <h3>New To {!! Config::get("site.name") !!}</h3>
        <div class="info">
          <a class = "btn btn-info" href = "{!! url('auth/register') !!}" style="margin-top:2%;margin-bottom:2%;">Create Account</a>
          <p>Forgot Your Password? Click <a class = "forgot" href = "{!! url('auth/forgot') !!}">Here</a></p>
        </div>
      </div>

      {!! csrf_field() !!}

  </form>
@endsection
