@extends("layouts.auth")

@section("content")
  <form role="form" action="{!! url("auth/reset") !!}" method="POST">
    <h3>Reset Password</h3>
    <div class="col-lg-8 col-lg-offset-2">

      <div class="form-group {!! $errors->has('password') ? 'has-error': '' !!}">
          {!! Form::label('password', 'New Password:') !!}
          <input type="password" class="form-control" name="password" required>
          @if ($errors->has('password'))
              <small class="help-inline text-danger">{!! $errors->first('password') !!}</small>
          @endif
      </div>

      <div class="form-group {!! $errors->has('confirm_password') ? 'has-error': '' !!}">
          {!! Form::label('confirm_password', 'Confirm Password:') !!}
          <input type="password" class="form-control" name="confirm_password" required>
          @if ($errors->has('confirm_password'))
              <small class="help-inline text-danger">{!! $errors->first('confirm_password') !!}</small>
          @endif
      </div>

      <input type="hidden" name="email" value="{!! Input::get("email") !!}">
      <input type="hidden" name="token" value="{!! Input::get("token") !!}">

    </div>

    {!! csrf_field() !!}
    <div class="col-lg-12" style="text-align:center">
      <button type="submit" class="btn btn-success">Reset Password</button>
    </div>
  </form>
@endsection
