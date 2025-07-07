<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
        protected $fillable = [
        'course_id',
        'event',
        'start_time',
        'end_time',
        'status',
        'location',
        'recurrence',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}