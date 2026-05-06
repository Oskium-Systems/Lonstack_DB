<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $settings = Setting::current();

        if ($settings->maintenance_mode && !Auth::check()) {
            return response()->view('maintenance', [
                'message' => $settings->maintenance_message,
            ], 503);
        }

        return $next($request);
    }
}
