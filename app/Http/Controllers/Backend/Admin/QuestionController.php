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
        return view('backend.master', compact('template', 'quiz', 'questions'));
    }

    // Xóa câu hỏi
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $quizId = $question->quiz_id;
        $question->delete();
        return redirect()->route('admin.question.index', $quizId)->with('success', 'Đã xóa câu');
    }

    public function studentStatus($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        // Lấy tất cả học sinh
        $students = User::where('role', 'student')->get();

        // Lấy kết quả làm bài của học sinh cho quiz này
        $results = QuizResult::where('quiz_id', $quizId)->with('student')->get()->keyBy('student_id');

        $studentsDone = [];
        $studentsNotDone = [];
        foreach ($students as $student) {
            if ($results->has($student->id)) {
                $studentsDone[] = [
                    'student' => $student,
                    'score' => $results[$student->id]->score,
                    'submitted_at' => $results[$student->id]->created_at,
                ];
            } else {
                $studentsNotDone[] = $student;
            }
        }

        $template = 'backend.admin.question.student_status';
        return view('backend.master', compact('template', 'quiz', 'studentsDone', 'studentsNotDone'));
    }
}