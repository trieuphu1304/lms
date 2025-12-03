<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use App\Models\QuizResult;

class QuestionController extends Controller
{
    // Hiển thị câu hỏi của bài kiểm tra
    public function index($quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        $questions = $quiz->questions;
        $template = 'backend.admin.question.index';
        return view('backend.admin.master', compact('template', 'quiz', 'questions', 'results'));
    }

    // Xóa câu hỏi
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $quizId = $question->quiz_id;
        $question->delete();
        return redirect()->route('admin.question.index', $quizId)->with('success', 'Đã xóa câu');
    }
}