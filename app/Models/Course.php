<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'level', 'teacher_id', 'avatar'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id')->withTimestamps();
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }


}