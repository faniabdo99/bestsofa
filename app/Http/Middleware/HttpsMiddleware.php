<?php

namespace App\Http\Middleware;

use Closure;
use App;
class HttpsMiddleware{
  public function handle($request, Closure $next){
      if (!$request->secure() && App::environment() === 'production') {
           return redirect()->secure($request->getRequestUri());
       }
       return $next($request);
    }
}
