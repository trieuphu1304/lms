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
            // Xác định đường dẫn để chuyển hướng
            $path = $request->is('teacher/*') ? route('teacher.login') : route('admin.login');
            return redirect($path)->with('error', 'Bạn cần đăng nhập để truy cập chức năng này.');
        }

        $user = Auth::user();

        // Nếu role trong $roles (hỗ trợ dạng số hoặc chuỗi)
        if (!in_array($user->role, $roles)) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        return $next($request);
    }
}