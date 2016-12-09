<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Sentry;

class Auth {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
      if( !Sentry::check() ) return Redirect::to( url("auth/login") );
      return $next($request);
    }
}
