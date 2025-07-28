<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;

class LessonController extends Controller
{
    public function show($id)
    {
        // Lấy bài học cùng khóa học, phần, bài kiểm tra
        $lesson = Lesson::with(['course.students', 'course.teacher', 'section', 'quizzes'])->findOrFail($id);
        $course = $lesson->course;

        // Lấy học viên hiện tại
        $user = Auth::user();
        $studentId = $user->id;

        // Kiểm tra xem học viên có đăng ký khóa học không
        if (!$course->students->contains($studentId)) {
            abort(403, 'Bạn chưa đăng ký khóa học này.');
        }

        // Lấy tất cả các phần và bài học của khóa học, kèm theo học viên đã học
        $sections = Section::with(['lessons.students'])->where('course_id', $course->id)->get();

        // Lấy cấp độ khóa học
        $courseLevel = $course->level ?? 'unknown';

        $currentLessonId = $lesson->id;
        $template = 'frontend.lesson.index';

        return view('frontend.master', compact(
            'lesson',
            'course',
            'sections',
            'studentId',
            'courseLevel',
            'template',
            'currentLessonId'
        ));
    }
}