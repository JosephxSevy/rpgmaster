@extends("layouts.auth")

@section("content")
  <form role="form" action="{!! url("auth/forgot") !!}" method="POST">
    <h3>Forgot Password</h3>
    <div class="col-lg-8 col-lg-offset-2">
      <div class="form-group {!! $errors->has('email') ? 'has-error': '' !!}">
          {!! Form::label('email', 'Email:') !!}
          {!! Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'name@example.com', 'required' => '')) !!}
          @if ($errors->has('email'))
              <small class="help-inline text-danger">{!! $errors->first('email') !!}</small>
          @endif
      </div>

    {!! csrf_field() !!}
    <div class="col-lg-12">
      <button type="submit" class="btn btn-success">Send Reminder</button>
    </div>
  </form>
@endsection
