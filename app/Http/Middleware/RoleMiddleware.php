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
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    { 
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập chức năng này.');
        }

        // Lấy user hiện tại
        $user = Auth::user();

        // Kiểm tra quyền
        if ($user->role !== $role) {
             return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập chức năng này.');       
        }

        return $next($request);
    }
}