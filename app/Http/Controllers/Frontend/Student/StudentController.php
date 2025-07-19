<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Course;

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
        $template = 'frontend.index';
        return view('frontend.master', compact('template','categories', 'courses', 'categoryId'));
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