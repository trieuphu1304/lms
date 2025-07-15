<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index($lessonId)
    {
        $lesson = Lesson::with('course')->findOrFail($lessonId);
        if ($lesson->course->teacher_id !== Auth::id()) abort(403);

        $quizzes = Quiz::where('lesson_id', $lessonId)->get();
        $template = 'backend.teacher.quiz.index';
        return view('backend.teacher.master', compact('template', 'quizzes', 'lesson'));
    }

    public function create($lessonId)
    {
        $lesson = Lesson::with('course')->findOrFail($lessonId);
        if ($lesson->course->teacher_id !== Auth::id()) abort(403);

        $template = 'backend.teacher.quiz.create';
        return view('backend.teacher.master', compact('template', 'lesson'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
        ]);

        $lesson = Lesson::with('course')->findOrFail($request->lesson_id);
        if ($lesson->course->teacher_id !== Auth::id()) abort(403);

        Quiz::create($request->only(['lesson_id', 'title']));

        return redirect()->route('teacher.lesson.quizzes', $request->lesson_id)->with('success', 'Đã tạo bài kiểm tra.');
    }

    public function edit($id)
    {
        $quiz = Quiz::with('lesson.course')->findOrFail($id);
        if ($quiz->lesson->course->teacher_id !== Auth::id()) abort(403);

        $lessons = Lesson::whereHas('course', function ($q) {
            $q->where('teacher_id', Auth::id());
        })->get();

        $template = 'backend.teacher.quiz.edit';
        return view('backend.teacher.master', compact('template', 'quiz', 'lessons'));
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::with('lesson.course')->findOrFail($id);
        if ($quiz->lesson->course->teacher_id !== Auth::id()) abort(403);

        $quiz->update($request->only(['title']));

        return redirect()->route('teacher.lesson.quizzes', $quiz->lesson_id)->with('success', 'Đã cập nhật.');
    }

    public function delete($id)
    {
        $quiz = Quiz::with('lesson.course')->findOrFail($id);
        if ($quiz->lesson->course->teacher_id !== Auth::id()) abort(403);

        $lessonId = $quiz->lesson_id;
        $quiz->delete();

        return redirect()->route('teacher.lesson.quizzes', $lessonId)->with('success', 'Đã xóa bài kiểm tra.');
    }
}