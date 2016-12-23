<header class="navbar navbar-inverse navbar-fixed-top container-fluid" id="main-header" role="banner">
    {!! HTML::style("css/app.css") !!}
    {!! HTML::script("js/jquery.min.js") !!}
    {!! HTML::script("js/bootstrap.min.js") !!}


    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <nav class="collapse navbar-collapse" id="collapse" role="navigation">
      <ul class="nav navbar-nav pull-left">

          <li> <a href="{!! url('') !!}">Home</a> </li>
          <li> <a href="{!! url('game') !!}">Games</a> </li>

      </ul>
      <ul class="nav navbar-nav pull-right">
          @if( !Sentry::check() )
            <li> <a href="{!! url('auth/login') !!}">Login</a> </li>
          @else
            <li> <a href="{!! url('character') !!}">My Characters</a> </li>
            <li> <a href="{!! url('auth/logout') !!}">Logout</a> </li>
          @endif

      </ul>

    </nav>
</header>
