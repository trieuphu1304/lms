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
    $lesson = Lesson::with(['course.students', 'course.teacher', 'section', 'quizzes'])->findOrFail($id);
    $course = $lesson->course;

    $user = Auth::user();
    $studentId = $user->id;

    if (!$course->students->contains($studentId)) {
        abort(403, 'Bạn chưa đăng ký khóa học này.');
    }

    // Ghi nhận đã học nếu chưa
    if (!$lesson->students->contains($studentId)) {
        $lesson->students()->attach($studentId, [
            'is_completed' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Tính tiến độ học
    $totalLessons = $course->lessons()->count();

    $completedLessons = $course->lessons()
        ->whereHas('students', function ($q) use ($studentId) {
            $q->where('student_id', $studentId);
        })->count();

    $progress = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

    // Cập nhật progress & completed_at nếu cần
    $pivotData = [
        'progress' => $progress,
        'updated_at' => now(),
    ];

    if ($progress === 100) {
        $pivotData['completed_at'] = now();
    }

    $user->enrollments()->updateExistingPivot($course->id, $pivotData);

    // Load dữ liệu view
    $sections = Section::with(['lessons.students'])->where('course_id', $course->id)->get();
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