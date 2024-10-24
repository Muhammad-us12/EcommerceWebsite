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

        if ($user->role == UserRoles::ADMIN) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == UserRoles::TEACHER) {
            return redirect()->route('teacher.dashboard');
        } elseif ($user->role == UserRoles::STUDENT) {
            return redirect()->route('student.dashboard');
        }

        return $next($request);
    }
}
