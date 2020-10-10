<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Support\Facades\Response as FacadesResponse;

class AuthenticateAccess
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $validSecrets = explode(',', env('ACCEPTED_SECRETS'));
    if (in_array($request->header('Authorization'), $validSecrets)) {
      return $next($request);
    }

    abort(Response::HTTP_UNAUTHORIZED);
  }
}
