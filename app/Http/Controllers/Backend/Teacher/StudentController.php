<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        // Lấy các khóa học mà giáo viên đang dạy
        $courses = Course::where('teacher_id', Auth::id())->get();

        // Lấy tất cả học viên trong các khóa học đó (kèm pivot: progress)
        $students = collect();

        foreach ($courses as $course) {
            foreach ($course->students as $student) {
                $student->course_title = $course->title;
                $student->progress = $student->pivot->progress ?? 0;
                $students->push($student);
            }
        }

        $template = 'backend.teacher.student.index';
        return view('backend.teacher.master', compact('template', 'students', 'courses'));
    }
}