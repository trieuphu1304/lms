<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\QuizResult;
use App\Models\Feedback;
use App\Models\Notification;
use App\Models\Certificate;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Section;
use App\Models\Category;
use App\Models\Review;


class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'description', 'role', 'avatar', 'class'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

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

    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_student', 'student_id', 'lesson_id')
            ->withPivot('is_completed')
            ->wherePivot('is_completed', true);
    }

    public function enrollments()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id')
            ->withTimestamps()
            ->withPivot(['enrolled_at', 'progress', 'completed_at']); // nếu muốn dùng thêm các cột này
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'student_id');
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    

}