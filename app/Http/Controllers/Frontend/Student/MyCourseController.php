<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MyCourseController extends Controller
{
    public function index(Request $request)
    {
        $template = 'frontend.course.my_course.index';
        $user = Auth::user();

        $query = $user->enrollments()->with('teacher', 'category', 'reviews');

        // Tìm kiếm
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc theo giáo viên
        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        // Lọc theo tiến độ
        if ($request->filled('progress')) {
            if ($request->progress == 'not_started') {
                $query->wherePivot('progress', 0);
            } elseif ($request->progress == 'in_progress') {
                $query->wherePivot('progress', '>', 0)->wherePivot('progress', '<', 100);
            } elseif ($request->progress == 'completed') {
                $query->wherePivot('progress', 100);
            }
        }

        // Sắp xếp
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'az':
                    $query->orderBy('title', 'asc');
                    break;
                case 'za':
                    $query->orderBy('title', 'desc');
                    break;
                case 'progress_asc':
                    $query->orderByPivot('progress', 'asc');
                    break;
                case 'progress_desc':
                    $query->orderByPivot('progress', 'desc');
                    break;
                default: // recent
                    $query->orderByPivot('enrolled_at', 'desc');
            }
        }
        // Lấy danh sách khóa học yêu thích của user (nếu đã đăng nhập)
        $wishlistCourses = [];
        if (auth()->check()) {
            $wishlistCourses = auth()->user()->favoriteCourses()->with('teacher')->get();
        }

        $courses = $query->paginate(6);
        $categories = Category::all();

        $enrollments = $user->enrollments()->with(['teacher', 'reviews'])->get();

        // Gán ratings trung bình cho từng course
        $courses->getCollection()->transform(function ($course) {
            $course->ratings = round($course->reviews->avg('rating'), 1) ?? 0;
            return $course;
        });

        $wishlistIds = auth()->check() ? auth()->user()->favoriteCourses()->pluck('courses.id')->toArray() : [];

        
        if ($request->ajax()) {
            return view('frontend.course.my_course.mycourse_list', compact('courses'))->render();
        }

        return view('frontend.master', compact('courses', 'wishlistCourses', 'categories', 'template', 'enrollments'));
    }

}