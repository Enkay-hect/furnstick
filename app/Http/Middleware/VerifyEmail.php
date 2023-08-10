<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmail
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
        // $is_verified = $request->only('is_verified');

        if (!Auth::user()->email_verified_at  ) {
            auth()->logout();
            return redirect()->route('login')
                    ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
          }

        return $next($request);
    }
}
//$$
//!User::where('is_verified', $is_verified)->first()
