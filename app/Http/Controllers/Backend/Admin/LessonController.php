<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;

class LessonController extends Controller
{
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);
        $lessons = $course->lessons()->get();
        $template = 'backend.admin.lesson.index';
        return view('backend.admin.master', compact('template', 'lessons', 'course'));
    }

    public function delete($id)
    {
        $lesson = Lesson::find($id);
        if ($lesson) {
            $courseId = $lesson->course_id;
            $lesson->delete();
            // Truyền $courseId vào route
            return redirect()->route('admin.lesson', $courseId)->with('success', 'Bài giảng đã được xóa!');
        }
        // Nếu không tìm thấy bài giảng, có thể redirect về trang danh sách khóa học hoặc trang trước đó
        return redirect()->back()->with('error', 'Không tìm thấy bài giảng!');
    }
}