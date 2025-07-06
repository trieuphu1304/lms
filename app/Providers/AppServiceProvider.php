<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
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
                $notifications = Notification::where('user_id', Auth::id())
                    ->latest()
                    ->take(5)
                    ->get();
            } else {
                $notifications = collect();
            }

            $view->with('notifications', $notifications);
        });

        Carbon::setLocale(config('app.locale'));
    }
}