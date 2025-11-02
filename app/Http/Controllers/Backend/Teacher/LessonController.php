<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;

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

        $lessons = $course->lessons()->with('section')->get();

        $template = 'backend.teacher.lesson.index';
        return view('backend.teacher.master', compact('template', 'lessons', 'course'));
    }


    public function create(Request $request)
    {
        $courseId = $request->get('course_id');

        $course = Course::with('sections')->findOrFail($courseId);
        $sections = $course->sections;

        $template = 'backend.teacher.lesson.create';
        return view('backend.teacher.master', compact('template', 'course', 'sections'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'section_id' => 'required|exists:sections,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'document_file' => 'nullable|mimes:pdf,doc,docx|max:10240', // 10MB
        ]);

        $filePath = null;

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');

            // Tạo tên file mới: DeTai_20251102_203512.docx
            $fileName = $originalName . '_' . $timestamp . '.' . $extension;

            // Lưu vào thư mục storage/app/public/lessons
            $filePath = $file->storeAs('lessons', $fileName, 'public');
            $filePath = 'storage/' . $filePath;
        }

        Lesson::create([
            'course_id' => $request->course_id,
            'section_id' => $request->section_id,
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'document_url' => $filePath, // lưu file path
        ]);

        return redirect()->route('teacher.lesson', $request->course_id)
                        ->with('success', 'Đã thêm bài giảng!');
    }



    public function edit($id)
    {
        $lesson = Lesson::with('course')->findOrFail($id);

        // Kiểm tra quyền
        if ($lesson->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa bài giảng này.');
        }
        $courses = Course::where('teacher_id', Auth::id())->get();
        $sections = $lesson->course->sections; 

        $template = 'backend.teacher.lesson.edit';
        return view('backend.teacher.master', compact('template', 'lesson', 'courses', 'sections'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'section_id' => 'required|exists:sections,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'document_file' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        $lesson = Lesson::with('course')->findOrFail($id);
        if ($lesson->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền cập nhật bài giảng này.');
        }

        $filePath = $lesson->document_url;

        if ($request->hasFile('document_file')) {
            if ($filePath && file_exists(public_path($filePath))) {
                unlink(public_path($filePath));
            }

            $file = $request->file('document_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');

            $fileName = $originalName . '_' . $timestamp . '.' . $extension;

            $filePath = $file->storeAs('lessons', $fileName, 'public');
            $filePath = 'storage/' . $filePath;
        }


        $lesson->update([
            'course_id' => $request->course_id,
            'section_id' => $request->section_id,
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'document_url' => $filePath,
        ]);

        return redirect()->route('teacher.lesson', $lesson->course_id)
                        ->with('success', 'Cập nhật bài giảng thành công!');
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