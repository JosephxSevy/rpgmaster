<!DOCTYPE HTML>
<html>

  <head>
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('img/logos/favicon.png') !!}">
    <title>{!! Config::get("site.title")!!} | Auth</title>
  </head>

  <body>
    @include("layouts.partials.header")
    @include("layouts.partials.message-bar")
    <div class="container auth" id="main-container">
      @yield("content")
    </div>
    @include("layouts.partials.footer")

  </body>

</html>
