<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizResultController extends Controller
{
    // Danh sách kết quả học viên theo quiz
    public function index($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $results = QuizResult::with('student')->where('quiz_id', $quizId)->get();
        $template = 'backend.admin.quiz_result.index';
        return view('backend.master', compact('template', 'quiz', 'results'));
    }

    // Xem chi tiết 1 kết quả
    public function show($id)
    {
        $result = QuizResult::with(['student', 'quiz'])->findOrFail($id);
        $template = 'backend.admin.quiz_result.detail';
        return view('backend.master', compact('template', 'result'));
    }

    // Xuất kết quả (Excel - optional)
    // public function export($quizId)
    // {
    //     return Excel::download(new QuizResultsExport($quizId), 'quiz_results.xlsx');

    //     $results = QuizResult::with('student')->where('quiz_id', $quizId)->get();

    //     // Nếu chưa cài package, có thể trả về thông báo:
    //     return back()->with('info', 'Chức năng xuất kết quả chưa được cài đặt!');
    // }
}