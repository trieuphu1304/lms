<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar', 'class'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function coursesTaught()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function coursesJoined()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id')->withTimestamps();
    }

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class, 'student_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}