<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Lesson;

class QuizController extends Controller
{
    // Hiển thị danh sách bài kiểm tra
    public function index()
    {
        $quizzes = Quiz::with('lesson')->get();
        $template = 'backend.admin.quiz.index';
        return view('backend.admin.master', compact('template', 'quizzes'));
    }

    // Xóa bài kiểm tra
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('admin.quiz.index')->with('success', 'Đã xóa bài kiểm tra!');
    }

    // Xem chi tiết 1 bài kiểm tra
    public function show($id)
    {
        $quiz = Quiz::with(['lesson', 'questions'])->findOrFail($id);
        $template = 'backend.admin.question.index';
        $questions = $quiz->questions;
        return view('backend.admin.master', compact('template', 'quiz', 'questions'));
    }
}