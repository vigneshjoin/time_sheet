<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserTypeMiddleware
{
    public function handle($request, Closure $next, ...$types)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if (in_array($user->user_type, $types)) {
            return $next($request);
        }

        abort(403, 'Unauthorized access');
    }
}
