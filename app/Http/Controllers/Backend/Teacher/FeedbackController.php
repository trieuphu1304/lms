<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Danh sách feedback của giáo viên hiện tại
    public function index(Request $request)
    {
        $template = 'backend.teacher.feedback.index';
        $teacherId = Auth::id();

        $query = Feedback::with('user', 'course')
            ->whereHas('course', function ($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            });

        // Tìm theo tên học viên
        if ($request->filled('student')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student . '%');
            });
        }

        // Tìm theo tên khóa học
        if ($request->filled('course')) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->course . '%');
            });
        }

        $feedbacks = $query->latest()->get();

        return view('backend.teacher.master', compact('template', 'feedbacks'));
    }


    // Xem chi tiết phản hồi
    public function show($id)
    {
        $template='backend.teacher.feedback.show';
        $feedback = Feedback::with('user', 'course')->findOrFail($id);
        // Nếu chưa đọc thì đánh dấu là đã đọc
        if (!$feedback->is_read) {
        $feedback->is_read = true;
        $feedback->save();
    }

        return view('backend.teacher.master', compact('template','feedback'));
    }


    // Xóa feedback
   public function delete($id)
    {
        $feedback = Feedback::with('course')->findOrFail($id);

        // Kiểm tra xem feedback có thuộc giáo viên hiện tại không qua khóa học
        if ($feedback->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền xóa phản hồi này.');
        }

        $feedback->delete();

        return redirect()->route('teacher.feedback')->with('success', 'Đã xóa phản hồi thành công.');
    }

}