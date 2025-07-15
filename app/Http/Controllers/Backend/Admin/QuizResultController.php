<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizResultController extends Controller
{
    
    public function listAll(Request $request)
    {
        $search = $request->input('search');

        $results = QuizResult::with(['student', 'quiz.lesson.course'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('student', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })->orWhereHas('quiz.lesson.course', function ($q) use ($search) {
                    $q->where('title', 'like', "%$search%");
                })->orWhereHas('quiz.lesson', function ($q) use ($search) {
                    $q->where('title', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(20); // Có phân trang

        $template = 'backend.admin.quiz_result.index';
        return view('backend.admin.master', compact('template', 'results', 'search'));
    }

    public function show($id)
    {
        $result = QuizResult::with(['student', 'quiz.lesson.course'])->findOrFail($id);
        $classAvgScore = QuizResult::where('quiz_id', $result->quiz_id)->avg('score');

        $template = 'backend.admin.quiz_result.detail';
        return view('backend.admin.master', compact('template', 'result', 'classAvgScore'));
    }
}