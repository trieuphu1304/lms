<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Hiển thị danh sách lịch trình của các khóa học học viên đã đăng ký
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->query('course_id');

        // Lấy danh sách khóa học học viên đã đăng ký
        $enrolledCourses = $user->coursesJoined()->get();

        // Lấy lịch trình của các khóa học
        $query = Schedule::with('course')
            ->whereIn('course_id', $enrolledCourses->pluck('id'))
            ->orderBy('start_time', 'asc');

        // Lọc theo khóa học nếu có
        if ($courseId && $enrolledCourses->pluck('id')->contains($courseId)) {
            $query->where('course_id', $courseId);
        }

        $schedules = $query->get();

        // Phân loại: sắp tới, đang diễn ra, đã hoàn thành
        $now = Carbon::now();
        $upcomingSchedules = $schedules->filter(fn($s) => Carbon::parse($s->start_time) > $now);
        $pastSchedules = $schedules->filter(fn($s) => Carbon::parse($s->end_time) <= $now);

        $template = 'frontend.schedule.index';
        return view('frontend.master', compact('template', 'enrolledCourses', 'schedules', 'upcomingSchedules', 'pastSchedules', 'courseId'));
    }

    /**
     * Lấy lịch trình của 1 khóa học (API)
     */
    public function getByCategory(Request $request, $courseId)
    {
        $user = Auth::user();
        $course = Course::findOrFail($courseId);

        // Kiểm tra học viên có đăng ký khóa học này không
        if (!$user->enrollments()->where('course_id', $courseId)->exists()) {
            abort(403, 'Bạn chưa đăng ký khóa học này.');
        }

        $schedules = Schedule::where('course_id', $courseId)
            ->orderBy('start_time', 'asc')
            ->get();

        return response()->json([
            'course' => $course,
            'schedules' => $schedules
        ]);
    }
}