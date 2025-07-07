<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Schedule;
use Carbon\Carbon;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $template = 'backend.teacher.dashboard.index';

        // Thống kê
        $coursesCount = Course::where('teacher_id', $user->id)->count();

        $studentsCount = User::whereHas('courses', function ($q) use ($user) {
            $q->where('teacher_id', $user->id);
        })->count();

        $lessonsCount = Lesson::whereHas('course', function ($q) use ($user) {
            $q->where('teacher_id', $user->id);
        })->count();

        $teachingMinutes = Schedule::whereHas('course', function ($q) use ($user) {
            $q->where('teacher_id', $user->id);
        })->selectRaw('SUM(TIMESTAMPDIFF(MINUTE, start_time, end_time)) as total_minutes')->value('total_minutes');

        $teachingHours = number_format(($teachingMinutes ?? 0) / 60, 1);

        // Bài giảng sắp tới (lấy theo thời gian hiện tại)
        $upcomingLessons = Schedule::with(['course'])
            ->whereHas('course', function ($q) use ($user) {
                $q->where('teacher_id', $user->id);
            })
            ->where('start_time', '>', now())
            ->orderBy('start_time')
            ->limit(5)
            ->get();

        // Tiến độ học kỳ
        $totalLessons = Lesson::whereHas('course', function ($q) use ($user) {
            $q->where('teacher_id', $user->id);
        })->count();

        $completedLessons = Schedule::whereHas('course', function ($q) use ($user) {
            $q->where('teacher_id', $user->id);
        })->where('start_time', '<', now())->count();

        $progressPercent = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

        // Lịch sử giảng dạy
        $teachingHistories = Schedule::whereHas('course', function ($q) use ($user) {
            $q->where('teacher_id', $user->id);
        })
        ->with('course')
        ->orderBy('start_time', 'desc')
        ->get()
        ->map(function ($item) {
            return (object)[
                'course_title' => $item->course->title,
                'date' => Carbon::parse($item->start_time),
                'start_time' => Carbon::parse($item->start_time)->format('H:i'),
                'end_time' => Carbon::parse($item->end_time)->format('H:i'),
                'duration' => Carbon::parse($item->start_time)->diffInMinutes(Carbon::parse($item->end_time)),
                'status' => $item->status ?? 'In Progress',
            ];
        });


        $teachingDates = $teachingHistories
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date))
            ->unique(fn($date) => $date->format('Y-m-d'))
            ->take(5);


        // Sự kiện sắp tới (hiển thị bên lịch)
        $upcomingSchedules = Schedule::with('course')
            ->whereHas('course', function ($q) use ($user) {
                $q->where('teacher_id', $user->id);
            })
            // ->where('start_time', '>', now())
            ->orderBy('start_time')
            ->limit(10)
            ->get();

        return view('backend.teacher.master', compact(
            'template',
            'coursesCount',
            'studentsCount',
            'lessonsCount',
            'teachingHours',
            'upcomingLessons',
            'progressPercent',
            'completedLessons',
            'totalLessons',
            'teachingHistories',
            'teachingDates',
            'upcomingSchedules'
        ));
    }

}