<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $template = 'backend.teacher.schedule.index';
        $schedules = Schedule::with('course')
            ->whereHas('course', function ($q) {
                $q->where('teacher_id', Auth::id());
            })
            ->latest()->get();

        return view('backend.teacher.master', compact('template', 'schedules'));
    }

    public function create()
    {
        $template = 'backend.teacher.schedule.create';
        $courses = Course::where('teacher_id', Auth::id())->get();

        return view('backend.teacher.master', compact('template', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'event' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $course = Course::findOrFail($request->course_id);
        if ($course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền tạo lịch trình cho khóa học này.');
        }

        $data = $request->all();
        if ($request->recurrence === 'Tùy chỉnh') {
            $data['recurrence'] = $request->input('custom_recurrence');
        }

        Schedule::create($data);

        return redirect()->route('teacher.schedule')->with('success', 'Tạo lịch trình thành công.');
    }

    public function edit($id)
    {
        $template = 'backend.teacher.schedule.edit';
        $schedule = Schedule::findOrFail($id);

        if ($schedule->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa lịch trình này.');
        }

        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('backend.teacher.master', compact('template', 'schedule', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'event' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $schedule = Schedule::findOrFail($id);

        if ($schedule->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền cập nhật lịch trình này.');
        }

        $data = $request->all();
        if ($request->recurrence === 'Tùy chỉnh') {
            $data['recurrence'] = $request->input('custom_recurrence');
        }

        $schedule->update($data);

        return redirect()->route('teacher.schedule')->with('success', 'Cập nhật lịch trình thành công.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);

        if ($schedule->course->teacher_id != Auth::id()) {
            abort(403, 'Bạn không có quyền xóa lịch trình này.');
        }

        $schedule->delete();
        return redirect()->route('teacher.schedule')->with('success', 'Đã xóa lịch trình.');
    }
}