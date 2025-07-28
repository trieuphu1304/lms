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
        // Trả lỗi nếu chưa đăng nhập
        if (!auth()->check()) {
            return response()->json(['message' => 'Bạn chưa đăng nhập.'], 401);
        }

        $course = Course::with('students')->findOrFail($courseId);

        // Chỉ cho học viên đã đăng ký
        if (!$course->students->contains(Auth::id())) {
            return response()->json(['message' => 'Bạn chưa đăng ký khóa học này.'], 403);
        }

        // Đã review chưa?
        $existingReview = Review::where('course_id', $courseId)
            ->where('student_id', auth()->id())
            ->first();

        if ($existingReview) {
            return response()->json(['message' => 'Bạn đã đánh giá khóa học này rồi.'], 409);
        }

        // Validate dữ liệu
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string|max:2000',
        ]);

        Review::create([
            'course_id' => $course->id,
            'student_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'rating' => $validated['rating'],
            'message' => $validated['message'] ?? null,
        ]);

        return response()->json(['message' => 'Đánh giá của bạn đã được gửi thành công!']);
    }

    public function fetch($id)
    {
        $reviews = Review::where('course_id', $id)
            ->latest()
            ->take(5) // hoặc paginate nếu cần
            ->get();

        return view('frontend.course.components.review', compact('reviews'));
    }


}