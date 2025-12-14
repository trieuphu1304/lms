<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gửi biến currentUser tới tất cả view backend
        View::composer('backend.*', function ($view) {
            $view->with('currentUser', Auth::user());
        });

        // Gửi notifications tới header giáo viên
        View::composer('backend.teacher.components.header', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                $notifications = Notification::where('user_id', $userId)
                    ->latest()
                    ->take(5)
                    ->get();

                $unreadCount = Notification::where('user_id', $userId)
                    ->where('is_read', false)
                    ->count();
            } else {
                $notifications = collect();
                $unreadCount = 0;
            }

            $view->with([
                'notifications' => $notifications,
                'unreadCount' => $unreadCount,
            ]);
        });

        // Gửi danh sách thông báo chưa đọc (học viên đăng ký) tới header admin
        View::composer('backend.admin.components.header', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                $adminNotifications = Notification::where('user_id', $userId)
                    ->where('is_read', false)
                    ->with('actor')
                    ->latest()
                    ->take(5)
                    ->get();
                $adminUnreadCount = Notification::where('user_id', $userId)
                    ->where('is_read', false)
                    ->count();
            } else {
                $adminNotifications = collect();
                $adminUnreadCount = 0;
            }

            $view->with([
                'adminNotifications' => $adminNotifications,
                'adminUnreadCount' => $adminUnreadCount,
            ]);
        });


        // Truyền $category vào header
        View::composer('frontend.components.header', function ($view) {
            $categories = Category::with(['courses' => function($q) {
                $q->limit(4);
            }])->get();
            $view->with('category', $categories);
        });

        Carbon::setLocale(config('app.locale'));
    }
}