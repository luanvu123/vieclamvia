<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Require2FA
{
    public function handle(Request $request, Closure $next, $guard = 'customer')  // Set default guard to 'customer'
    {
        $user = Auth::guard($guard)->user();

        if ($user && $user->is2Fa && !$request->session()->has('2fa_verified')) {
            // Redirect to the 2FA verification page
            return redirect()->route('2fa.verify');
        }

        return $next($request);
    }
}
