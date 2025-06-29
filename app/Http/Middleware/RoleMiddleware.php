<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            $path = $request->is('teacher/*') ? route('teacher.login') : route('admin.login');
            return redirect($path)->with('error', 'Bạn cần đăng nhập để truy cập.');
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $path = $request->is('teacher/*') ? route('teacher.login') : route('admin.login');
            return redirect($path)->with('error', 'Bạn không có quyền với tài khoản này, vui lòng đăng nhập lại.');
        }

        return $next($request);
    }

}