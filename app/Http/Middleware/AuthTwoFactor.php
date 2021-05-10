<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthTwoFactor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = Auth::user();
        if (
            auth()->check()
            && !empty($auth->two_factor_code)
            && !empty($auth->authTwoFactor)
        ) {
            if (now()->gt($auth->two_factor_expires_at)) {
                $auth->resetTwoFactorCode();
                Auth::logout();

                return redirect()
                    ->route('login')
                    ->with('error', 'The two factor code has expired. Please login again.');
            }

            if (!$request->is('otp*')) {
                return redirect()->route('otp.verify');
            }
        }

        return $next($request);
    }
}
