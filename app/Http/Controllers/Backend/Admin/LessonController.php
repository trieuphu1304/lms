<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;

class LessonController extends Controller
{
    public function index($courseId)
    {
        // Lấy khóa học
        $course = Course::findOrFail($courseId);

        // Lấy các bài giảng thuộc khóa học, kèm section
        $lessons = $course->lessons()->with('section')->get();

        $template = 'backend.admin.lesson.index';
        return view('backend.admin.master', compact('template', 'lessons', 'course'));
    }

    public function delete($id)
    {
        $lesson = Lesson::find($id);
        if ($lesson) {
            $courseId = $lesson->course_id;
            $lesson->delete();

            return redirect()->route('admin.lesson', $courseId)->with('success', 'Bài giảng đã được xóa!');
        }

        return redirect()->back()->with('error', 'Không tìm thấy bài giảng!');
    }
}