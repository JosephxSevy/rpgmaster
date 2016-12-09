<?php

namespace App\Http\Middleware;

use Sentry;
use Closure;
use Redirect;

class IsAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
      if( !Sentry::check() )return Redirect::to( url("auth/login") );
      if( !Sentry::getUser()->hasPermission("admin") )return Redirect::to( url("auth/login") );
      return $next($request);
    }
}
