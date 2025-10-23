<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Danh sách review của giáo viên hiện tại
    public function index(Request $request)
    {
        $template = 'backend.teacher.feedback.index';
        $teacherId = Auth::id();

        $query = Review::with('student', 'course')
            ->whereHas('course', function ($q) use ($teacherId) {
                $q->where('teacher_id', $teacherId);
            });

        // Tìm theo tên học viên
        if ($request->filled('student')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student . '%');
            });
        }

        // Tìm theo tên khóa học
        if ($request->filled('course')) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->course . '%');
            });
        }

        $reviews = $query->latest()->get();

        return view('backend.teacher.master', compact('template', 'reviews'));
    }


    // Xem chi tiết phản hồi
    public function show($id)
    {
        $template='backend.teacher.feedback.show';
        $review = Review::with('student', 'course')->findOrFail($id);
        // Nếu chưa đọc thì đánh dấu là đã đọc
        if (!$review->is_read) {
        $review->is_read = true;
        $review->save();
    }

        return view('backend.teacher.master', compact('template','review'));
    }


    // Xóa review
   public function delete($id)
    {
        $review = Review::with('course')->findOrFail($id);

        // Kiểm tra xem review có thuộc giáo viên hiện tại không qua khóa học
        if ($review->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền xóa phản hồi này.');
        }

        $review->delete();

        return redirect()->route('teacher.feedback')->with('success', 'Đã xóa phản hồi thành công.');
    }

}