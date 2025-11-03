<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * Usage in routes: ->middleware('user_type:staff') or ->middleware('user_type:super_admin,admin')
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // If not authenticated, redirect to login (or abort)
        if (! Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        // If no roles specified, allow access
        if (empty($roles)) {
            return $next($request);
        }

        // Roles passed may be comma separated in a single parameter; normalize into flat array
        $allowed = [];
        foreach ($roles as $r) {
            $parts = array_filter(array_map('trim', explode(',', $r)));
            $allowed = array_merge($allowed, $parts);
        }

        // If user's type matches any allowed role, continue
        if (in_array($user->user_type, $allowed, true)) {
            return $next($request);
        }

        // Otherwise deny access
        abort(403, 'Unauthorized.');
    }
}
