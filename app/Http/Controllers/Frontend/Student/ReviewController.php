<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        // Chỉ cho học viên đã đăng ký mới được đánh giá
        if (!$course->students->contains(Auth::id())) {
            return redirect()->back()->with('error', 'Bạn chưa đăng ký khóa học này.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string|max:2000',
        ]);

        Review::create([
            'course_id' => $course->id,
            'student_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'rating' => $request->rating,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi.');
    }
}