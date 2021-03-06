<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use Symfony\Component\HttpFoundation\Session\Session;

class CheckIfEmailValidated
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
        if (!Auth::user()->hasConfirmedEmail()) {
            return redirect()->route('registration.confirm-email');
        }
        return $next($request);
    }
}
