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
        $wishlistIds = [];
        if (auth()->check()) {
            $wishlistIds = auth()->user()->favoriteCourses()->pluck('courses.id')->toArray();
        }
        $testimonials = Review::with(['student', 'course']) 
            ->latest()
            ->take(10)
            ->get();    
        $template = 'frontend.index';
        return view('frontend.master', compact('template','categories', 'courses', 'categoryId', 'testimonials', 'wishlistIds'));
    }

    public function ajaxCourses(Request $request)
    {
        $categoryId = $request->query('category_id');
        if ($categoryId) {
            $courses = Course::where('category_id', $categoryId)->latest()->take(6)->get();
        } else {
            $courses = Course::latest()->take(6)->get();
        }
        $wishlistIds = [];
        if (auth()->check()) {
            $wishlistIds = auth()->user()->favoriteCourses()->pluck('courses.id')->toArray();
        }
        // Trả về view partial chỉ chứa danh sách khóa học
        return view('frontend.components_index.course_list', compact('courses', 'wishlistIds'))->render();
    }}