<?php
namespace App\Http\Middleware;

class CorsMiddleware {
  public function handle($request, \Closure $next)
  {
    if($request->isMethod('OPTIONS')){
      $response = response('', 200);
    } else {
      $response = $next($request);
    }

    $response->header('Access-Control-Allow-Headers', "Origin, X-Requested-With, Content-Type, Accept");
    $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS');
    $response->header('Access-Control-Allow-Credentials', 'true');
    $response->header('Access-Control-Max-Age', '86400');
    $response->header('Access-Control-Allow-Origin', '*');
    return $response;
  }
}