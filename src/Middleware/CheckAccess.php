<?php

namespace Dolati\Uploader\Middleware;

use Closure;

class CheckAccess {

    public function handle($request , Closure $next){

        // dd('CheckAccess-Middleware');
        return $next($request);

    }
}
