<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWTAuth;

class JWTMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                $response = responseFail(trans("messages.jwt-invalid"));
                return response()->json($response, 500, [], JSON_PRETTY_PRINT);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                $response = responseFail(trans("messages.jwt-expired"));
                return response()->json($response, 500, [], JSON_PRETTY_PRINT);
            }else{
                $response = responseFail(trans("messages.jwt-not-found"));
                return response()->json($response, 500, [], JSON_PRETTY_PRINT);
            }
        }
        return $next($request);

    }
}
