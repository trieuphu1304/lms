<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
        'student_id',
        'quiz_id',
        'quiz_result_id',
        'question_id',
        'answer',
        'selected_option',
        'is_correct',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function quizResult()
    {
        return $this->belongsTo(QuizResult::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}