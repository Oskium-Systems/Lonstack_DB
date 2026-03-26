<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

trait HandlesLoginResponse
{
    /**
     * Handle the login response and redirect to the appropriate dashboard.
     */
    protected function sendLoginResponse(Request $request): RedirectResponse
    {
        $redirectRoutes = [
            'access-admin-dashboard' => 'admin.dashboard',
            'access-user-dashboard' => 'user.dashboard',
        ];

    

        foreach ($redirectRoutes as $gate => $route) {
            if (Gate::allows($gate)) {
                // Redirect to the intended dashboard with a success message
                return redirect()->intended(route($route, absolute: false))
                    ->with('success', 'You have successfully logged in!');
            }
        }


        Auth::logout();
        return redirect()->route('login')->with('error', 'Your account does not have access to any dashboard');
    }
}
