<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CheckMaintenanceMode
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
        $isMaintenanceMode = Config::get('settings.maintenance_mode', false);

        // Check if maintenance mode is enabled
        if ($isMaintenanceMode) {
            // Check if the user is authenticated with web guard and isAdmin is 0
            if (Auth::guard('web')->check()) {
                $user = Auth::guard('web')->user();
                if ($user->role == 'Administrator') {
                    // Admin user with isAdmin = 0, allow access
                    return $next($request);
                }
            }

            // Redirect all other authenticated users to maintenance page
            if (Auth::guard('web')->check()) {
                return response()->view('maintenanceserver');
            }
        }

        // Allow request to proceed if maintenance mode is not enabled
        return $next($request);
    }
}
