<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Nếu route bắt đầu bằng "teacher/", redirect về trang đăng nhập giáo viên
            if ($request->is('teacher/*')) {
                return route('teacher.login');
            }

            // Mặc định: redirect về trang login admin
            return route('admin.login');
        }

        return null;
    }

}