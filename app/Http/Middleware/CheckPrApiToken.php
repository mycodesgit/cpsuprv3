<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Company;

class CheckPrApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-TOKEN');

        if (!$token || $token !== env('PR_API_TOKEN')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Invalid API token.'
            ], 401);
        }

        return $next($request);
    }
}