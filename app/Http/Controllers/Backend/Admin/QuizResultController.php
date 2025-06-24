<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class QuizResultController extends Controller
{
    // Danh sách kết quả học viên theo quiz
    public function index($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $results = QuizResult::with('student')->where('quiz_id', $quizId)->get();

        // Lấy danh sách học viên của khóa học này
        $courseId = $quiz->lesson ? $quiz->lesson->course_id : null;

        $studentIds = [];
        if ($courseId) {
            $studentIds = DB::table('course_student')
                ->where('course_id', $courseId)
                ->pluck('student_id');
        }

        $students = User::whereIn('id', $studentIds)->get();

        // Lấy id học viên đã làm bài
        $doneStudentIds = $results->pluck('student_id')->toArray();

        // Học viên chưa làm bài
        $notDoneStudents = $students->whereNotIn('id', $doneStudentIds);

        // dd($quiz->course_id, $studentIds, $students, $doneStudentIds, $notDoneStudents);

        $template = 'backend.admin.quiz_result.index';
        return view('backend.master', compact(
            'template', 
            'quiz', 
            'results',
            'students',
            'doneStudentIds',
            'notDoneStudents'
        ));
    }
    
    // Xem chi tiết 1 kết quả
    public function show($id)
    {
        $result = QuizResult::with(['student', 'quiz'])->findOrFail($id);
        $classAvgScore = QuizResult::where('quiz_id', $result->quiz_id)->avg('score');
        $template = 'backend.admin.quiz_result.detail';
        return view('backend.master', compact('template', 'result', 'classAvgScore'));
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