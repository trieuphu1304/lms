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
        $student = $request->input('student');
        $quiz = $request->input('quiz');
        $course = $request->input('course');

        $query = QuizResult::with(['student', 'quiz.lesson.course']);

        // Filter by student name
        if ($student) {
            $query->whereHas('student', function ($q) use ($student) {
                $q->where('name', 'like', "%$student%");
            });
        }

        // Filter by quiz title
        if ($quiz) {
            $query->whereHas('quiz', function ($q) use ($quiz) {
                $q->where('title', 'like', "%$quiz%");
            });
        }

        // Filter by course title
        if ($course) {
            $query->whereHas('quiz.lesson.course', function ($q) use ($course) {
                $q->where('title', 'like', "%$course%");
            });
        }

        // Legacy search parameter (searches all fields)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', function ($sq) use ($search) {
                    $sq->where('name', 'like', "%$search%");
                })->orWhereHas('quiz', function ($sq) use ($search) {
                    $sq->where('title', 'like', "%$search%");
                })->orWhereHas('quiz.lesson.course', function ($sq) use ($search) {
                    $sq->where('title', 'like', "%$search%");
                });
            });
        }

        $results = $query->latest()->paginate(20);

        $template = 'backend.admin.quiz_result.index';
        return view('backend.admin.master', compact('template', 'results', 'search', 'student', 'quiz', 'course'));
    }

    public function show($quizId)
{
    // Lấy quiz kèm câu hỏi
    $quiz = Quiz::with('questions')->findOrFail($quizId);

    // Lấy danh sách kết quả kèm thông tin học viên
    $results = QuizResult::where('quiz_id', $quizId)
        ->with('student')
        ->get();

    // Tính điểm trung bình lớp (giữ dạng thập phân ví dụ: 6.6)
    $classAvgScore = round(QuizResult::where('quiz_id', $quizId)->avg('score'), 1);

    // Trả về view
    $template = 'backend.admin.quiz_result.detail';

    return view('backend.admin.master', compact(
        'template',
        'quiz',
        'results',
        'classAvgScore'
    ));
}


}