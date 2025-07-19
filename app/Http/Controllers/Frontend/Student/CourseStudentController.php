<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class CourseStudentController extends Controller
{
    public function index(Request $request)
    {
        $totalCourses = Course::count();

        // Bắt đầu query với eager load quan hệ
        $query = Course::with('teacher', 'category');
        
        // Lọc theo category
        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->input('categories'));
        }

        // Lọc theo cấp độ
        if ($request->filled('levels')) {
            $query->whereIn('level', $request->input('levels'));
        }

        // Lọc theo giáo viên
        if ($request->filled('teachers')) {
            $query->whereIn('teacher_id', $request->input('teachers'));
        }

        // Lọc thủ công theo 1 danh mục được truyền trực tiếp (ví dụ từ tab danh mục)
        $categoryId = $request->input('category');
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        // Lấy danh sách categories có đếm số khóa học
        $categories = Category::withCount('courses')->get();

        // Lấy danh sách giáo viên duy nhất từ khóa học
        $teachers = Course::with('teacher')->get()->pluck('teacher')->unique('id')->values();

        // Lấy các khóa học sau khi lọc
        $courses = Course::paginate(6);


        $template = 'frontend.course.index';
        return view('frontend.master', compact(
            'template',
            'totalCourses',
            'courses',
            'categories',
            'categoryId',
            'teachers'
        ));
    }
    public function filter(Request $request)
    {
        $query = Course::query();

        // Lọc theo category
        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        // Lọc theo level
        if ($request->has('levels')) {
            $query->whereIn('level', $request->levels);
        }

        // Lọc theo teacher
        if ($request->has('teachers')) {
            $query->whereIn('teacher_id', $request->teachers);
        }

        $courses = $query->latest()->get();

        // Trả về HTML thay vì redirect
        $html = view('frontend.course.components.course-list', compact('courses'))->render();

        return response()->json(['html' => $html]);
    }


}