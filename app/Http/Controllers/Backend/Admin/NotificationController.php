<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markRead(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            \App\Models\Notification::whereIn('id', $ids)
                ->where('user_id', auth()->id())
                ->update(['is_read' => true]);
        }
        $unread = \App\Models\Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();
        return response()->json(['message' => 'OK', 'unread' => $unread], 200);
    }

    public function destroy(Request $request)
    {
        return response()->json(['message' => 'Cleared'], 200);
    }
}
