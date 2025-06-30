<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['course_id', 'title', 'content', 'video_url', 'document_url'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'lesson_student', 'lesson_id', 'student_id')
            ->withPivot('is_completed')
            ->withTimestamps();
    }
}