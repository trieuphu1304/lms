<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index($courseId)
    {
        $teacherId = Auth::id();

        // Chỉ lấy các bài giảng thuộc khóa học của giáo viên hiện tại
        $course = Course::where('id', $courseId)
                        ->where('teacher_id', $teacherId)
                        ->firstOrFail();

        $lessons = Lesson::where('course_id', $course->id)->with('course')->get();

        $template = 'backend.teacher.lesson.index';
        return view('backend.teacher.master', compact('template', 'lessons', 'course'));
    }


    public function create()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        $template = 'backend.teacher.lesson.create';
        return view('backend.teacher.master', compact('template', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'document_url' => 'nullable|url',
        ]);

        Lesson::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'document_url' => $request->document_url,
        ]);

        return redirect()->route('teacher.lesson', $request->course_id)->with('success', 'Đã thêm bài giảng!');
    }


    public function edit($id)
    {
        $lesson = Lesson::with('course')->findOrFail($id);

        // Kiểm tra giáo viên có sở hữu bài giảng không
        if ($lesson->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa bài giảng này.');
        }

        $courses = Course::where('teacher_id', Auth::id())->get();
        $template = 'backend.teacher.lesson.edit';
        return view('backend.teacher.master', compact('template', 'lesson', 'courses'));
    }


    public function update(Request $request, $id)
    {
        $lesson = Lesson::with('course')->findOrFail($id);

        if ($lesson->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền cập nhật bài giảng này.');
        }

        $lesson->update($request->only(['course_id', 'title', 'content', 'video_url', 'document_url']));

        return redirect()->route('teacher.lesson', $lesson->course_id)->with('success', 'Cập nhật bài giảng thành công!');
    }


    public function delete($id)
    {
        $lesson = Lesson::with('course')->findOrFail($id);

        if ($lesson->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền xóa bài giảng này.');
        }

        $lesson->delete();

        return redirect()->route('teacher.lesson', $lesson->course_id)->with('success', 'Xóa bài giảng thành công!');
    }
}