
<footer style="position:absolute; bottom:0;" class="navbar navbar-inverse" id="main-footer">

    <ul class="navbar-nav nav pull-right">
      <li><a href="{!! url("contact") !!}"> Contact Us</a></li>
      <li><a href="{!! url("story") !!}">Our Story</a></li>
    </ul>

    <ul class="navbar-nav nav pull-left">
    <li>
      <span>&copy; {!! date("Y") . " " . Config::get("site.name") !!}</span>
    </li>
    </ul>
</footer>
