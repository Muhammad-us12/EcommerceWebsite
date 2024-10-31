<?php

namespace App\Http\Middleware;

use App\Enums\UserRoles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->role == UserRoles::ADMIN->value) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == UserRoles::VENDOR->value) {
            return redirect()->route('vendor.dashboard');
        } elseif ($user->role == UserRoles::CUSTOMER->value) {
            return redirect()->route('customer.dashboard');
        }

        return $next($request);
    }
}
