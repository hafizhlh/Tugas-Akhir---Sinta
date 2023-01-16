<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddlewareAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (app('auth')->guest()) {
            // throw UnauthorizedException::notLoggedIn();
            $response = responseFail(['user'=>[trans('messages.spatie-not-login')]]);
            return response()->json($response, 401, [], JSON_PRETTY_PRINT);
        }

        if (app('auth')->user()->can($permission)) {
            return $next($request);
        }  
        
        $response = responseFail(trans('messages.spatie-not-permission'),['user'=>[trans('messages.spatie-not-permission')]]);
        return response()->json($response, 403, [], JSON_PRETTY_PRINT);

    }
}
