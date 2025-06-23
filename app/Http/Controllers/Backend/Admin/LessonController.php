<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('course')->get();
        $template = 'backend.admin.lesson.index';
        return view('backend.master', compact('template', 'lessons'));
    }

    public function delete($id)
    {
        $lesson = Lesson::find($id);
        if ($lesson) {
            $lesson->delete();
            return redirect()->route('admin.lesson')->with('success', 'Bài giảng đã được xóa!');
        }
        return redirect()->route('admin.lesson')->with('error', 'Không tìm thấy bài giảng!');
    }
}