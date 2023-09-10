<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ifToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $token = $request->header('Authorization');

        if (!$token) {
            return \response()->json('token no existe');
        } else {

            $usuario = Auth::guard('sanctum')->user();
            if (!$usuario) {
                return \response()->json('njo isrve token');
            } else {
                return $next($request);
            }
        }
    }
}
