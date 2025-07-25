<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Course;
use App\Models\Review;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('courses')->latest()->take(6)->get();

        $categoryId = $request->query('category_id'); // KHÔNG gán mặc định
        if ($categoryId) {
            $courses = Course::where('category_id', $categoryId)->latest()->take(6)->get();
        } else {
            $courses = Course::latest()->take(6)->get();
        }

        $reviews = Review::with('student') // eager load student
            ->where('rating', 5)
            ->orderBy('created_at', 'desc')
            ->get();

        $template = 'frontend.index';
        return view('frontend.master', compact('template','categories', 'courses', 'categoryId', 'reviews'));
    }

    public function ajaxCourses(Request $request)
    {
        $categoryId = $request->query('category_id');
        if ($categoryId) {
            $courses = \App\Models\Course::where('category_id', $categoryId)->latest()->take(6)->get();
        } else {
            $courses = \App\Models\Course::latest()->take(6)->get();
        }
        // Trả về view partial chỉ chứa danh sách khóa học
        return view('frontend.components_index.course_list', compact('courses'))->render();
    }}