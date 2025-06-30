<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index($quizId)
    {
        $quiz = Quiz::with('lesson.course')->findOrFail($quizId);
        if ($quiz->lesson->course->teacher_id !== Auth::id()) abort(403);

        $questions = Question::where('quiz_id', $quizId)->get();
        $template = 'backend.teacher.question.index';
        return view('backend.teacher.master', compact('template', 'questions', 'quiz'));
    }

    public function create($quizId)
    {
        $quiz = Quiz::with('lesson.course')->findOrFail($quizId);
        if ($quiz->lesson->course->teacher_id !== Auth::id()) abort(403);

        $template = 'backend.teacher.question.create';
        return view('backend.teacher.master', compact('template', 'quiz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        $quiz = Quiz::with('lesson.course')->findOrFail($request->quiz_id);
        if ($quiz->lesson->course->teacher_id !== Auth::id()) abort(403);

        Question::create($request->only([
            'quiz_id', 'question_text', 'option_a', 'option_b',
            'option_c', 'option_d', 'correct_option'
        ]));

        return redirect()->route('teacher.question', $request->quiz_id)->with('success', 'Đã thêm câu hỏi.');
    }

    public function edit($id)
    {
        $question = Question::with('quiz.lesson.course')->findOrFail($id);
        if ($question->quiz->lesson->course->teacher_id !== Auth::id()) abort(403);

        $template = 'backend.teacher.question.edit';
        return view('backend.teacher.master', compact('template', 'question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::with('quiz.lesson.course')->findOrFail($id);
        if ($question->quiz->lesson->course->teacher_id !== Auth::id()) abort(403);

        $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        $question->update($request->only([
            'question_text', 'option_a', 'option_b',
            'option_c', 'option_d', 'correct_option'
        ]));

        return redirect()->route('teacher.question', $question->quiz_id)->with('success', 'Đã cập nhật câu hỏi.');
    }

    public function delete($id)
    {
        $question = Question::with('quiz.lesson.course')->findOrFail($id);
        if ($question->quiz->lesson->course->teacher_id !== Auth::id()) abort(403);

        $quizId = $question->quiz_id;
        $question->delete();

        return redirect()->route('teacher.question', $quizId)->with('success', 'Đã xóa câu hỏi.');
    }
}