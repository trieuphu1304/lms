<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;

class ResultController extends Controller
{
    public function allResults(Request $request)
    {
        $template = 'backend.teacher.quiz_results.index';
        $teacherId = Auth::id();

        $results = QuizResult::whereHas('quiz.lesson.course', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })
        ->with(['student', 'quiz.lesson.course'])
        ->when($request->student, function ($query, $studentName) {
            $query->whereHas('student', function ($q) use ($studentName) {
                $q->where('name', 'LIKE', "%$studentName%");
            });
        })
        ->when($request->quiz, function ($query, $quizTitle) {
            $query->whereHas('quiz', function ($q) use ($quizTitle) {
                $q->where('title', 'LIKE', "%$quizTitle%");
            });
        })
        ->when($request->course, function ($query, $courseTitle) {
            $query->whereHas('quiz.lesson.course', function ($q) use ($courseTitle) {
                $q->where('title', 'LIKE', "%$courseTitle%");
            });
        })
        ->latest()
        ->get();
        return view('backend.teacher.master', compact('template','results'));
    }

    public function quizResults($quizId)
    {
        $template = 'backend.teacher.quiz_results.by_quiz';
        $teacherId = Auth::id();
        $quiz = Quiz::findOrFail($quizId);
        $results = QuizResult::where('quiz_id', $quizId)
            ->whereHas('quiz.lesson.course', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->with(['student', 'quiz.lesson.course'])
            ->orderByDesc('submitted_at')
            ->get();

        return view('backend.teacher.master', compact('template', 'results', 'quiz'));
    }

}