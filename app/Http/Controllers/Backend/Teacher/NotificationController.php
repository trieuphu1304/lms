<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Xem tất cả
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('backend.teacher.master', compact('notifications'));
    }

    public function markAllRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }


    // Xóa tất cả
    public function destroyAll()
    {
        Notification::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Đã xóa tất cả thông báo');
    }
}