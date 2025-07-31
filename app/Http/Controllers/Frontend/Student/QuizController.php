<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\Question;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function show($lessonId)
    {
        $template = 'frontend.quiz.index';

        // Tìm bài học và nạp các bài kiểm tra + câu hỏi liên quan
        $lesson = Lesson::with(['quizzes.questions'])->findOrFail($lessonId);

        // Lấy bài kiểm tra đầu tiên (nếu có)
        $quiz = $lesson->quizzes->first();

        if (!$quiz) {
            abort(404, 'Không tìm thấy bài kiểm tra.');
        }

        // Lấy danh sách câu hỏi của bài kiểm tra
        $questions = $quiz->questions;

        session(['quiz_start_time' => now()]);

        // Trả về view master và nhúng nội dung từ template
        return view('frontend.master', compact('lesson', 'quiz', 'questions', 'template'));
    }


public function submit(Request $request, $lessonId)
{
    $lesson = Lesson::findOrFail($lessonId);
    $quiz = $lesson->quizzes->first();
    $user = Auth::user();

    if (!$quiz) {
        abort(404, 'Bài kiểm tra không tồn tại.');
    }

   $startTime = session('quiz_start_time') 
    ? Carbon::parse(session('quiz_start_time')) 
    : now(); // fallback nếu mất session

    $endTime = now();
    $durationInSeconds = max(0, $endTime->diffInSeconds($startTime)); // tránh âm

    $durationFormatted = floor($durationInSeconds / 60) . ' phút ' . ($durationInSeconds % 60) . ' giây';


    $score = 0;
    $answers = [];

    foreach ($quiz->questions as $question) {
        $userAnswer = $request->input("answers.{$question->id}");
        $selectedText = $question->{'option_' . $userAnswer};
        $correctOption = $question->correct_option;

        $isCorrect = strtolower($userAnswer) === strtolower($correctOption);
        $score += $isCorrect ? 1 : 0;

        $answers[] = [
            'question_id' => $question->id,
            'question' => $question->question_text,
            'answer' => $userAnswer, // a/b/c/d
            'selected_option' => $selectedText,
            'correct' => $correctOption, // a/b/c/d
            'correct_text' => $question->{'option_' . $correctOption},
            'is_correct' => $isCorrect,
        ];
    }

    $quizResult = QuizResult::create([
        'quiz_id' => $quiz->id,
        'student_id' => $user->id,
        'score' => $score,
        'total_questions' => $quiz->questions->count(),
        'correct_answers' => $score,
        'submitted_at' => $endTime,
        'duration' => $durationFormatted,
    ]);

    foreach ($answers as $answer) {
        StudentAnswer::create([
            'student_id' => $user->id,
            'quiz_id' => $quiz->id,
            'quiz_result_id' => $quizResult->id,
            'question_id' => $answer['question_id'],
            'answer' => $answer['answer'],
            'selected_option' => $answer['selected_option'],
            'is_correct' => $answer['is_correct'],
        ]);
    }

    session()->flash('quiz_result', [
        'score' => $score,
        'total' => $quiz->questions->count(),
        'percentage' => round(($score / $quiz->questions->count()) * 100),
        'answers' => $answers,
        'duration' => $durationFormatted,
        'submitted_at' => $endTime,
    ]);

    return redirect()->route('quiz.result', $lessonId);
}


    public function result($lessonId)
{
    $template = 'frontend.quiz.result';

    // Lấy bài học kèm theo thông tin khóa học và giáo viên
    $lesson = Lesson::with('course.teacher')->findOrFail($lessonId);
    $quiz = $lesson->quizzes->first();

    // Lấy kết quả bài làm từ session (tạm thời)
    $result = session('quiz_result');

    if (!$result) {
        return redirect()->route('quiz.show', $lessonId);
    }

    // Truyền thêm dữ liệu course và teacher để hiển thị view đẹp
    $course = $lesson->course;
    $teacher = $course->teacher ?? null;

    return view('frontend.master', compact(
        'lesson',
        'quiz',
        'result',
        'course',
        'teacher',
        'template'
    ));
}

}