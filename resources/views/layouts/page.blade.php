<!DOCTYPE HTML>
<html>
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('img/logos/favicon.png') !!}">
    <title>{!! Config::get("site.title")!!}</title>
  </head>

  <body>
    @include("layouts.partials.header")
    @include("layouts.partials.message-bar")
    <div class="container-fluid page" id="main-container">


      <div class="content" style="margin-top:66px;">
        @yield("content")
      </div>

    </div>
    @include("layouts.partials.footer")
  </body>

</html>
