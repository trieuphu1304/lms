<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;

class CourseDetailController extends Controller
{
    public function index($id)
    {
        //Lấy nội dung bài giảng
        $lessons = Lesson::where('course_id', $id)->get();
        
        
        // Lấy thông tin khóa học theo ID
        $course = Course::with(['teacher', 'category'])->findOrFail($id);
        
        $template = 'frontend.course.detail';
        return view('frontend.master', compact(
            'template',
            'course',
            'lessons'
        ));
    }
    
    
}