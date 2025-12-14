<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Quiz;   
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function dashboard()
    {   
        $totalStudents = User::where('role', 'student')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalCourses = Course::count();
        $totalQuizzes = Quiz::count();

        // Last 12 months labels
        $start = Carbon::now()->subMonths(11)->startOfMonth();
        $months = [];
        $newStudents = [];
        $completedLessons = [];
        for ($i = 0; $i < 12; $i++) {
            $mStart = $start->copy()->addMonths($i)->startOfMonth();
            $mEnd = $mStart->copy()->endOfMonth();
            $months[] = $mStart->format('M Y');

            $newStudents[] = User::where('role', 'student')
                ->whereBetween('created_at', [$mStart, $mEnd])
                ->count();

            $completedLessons[] = DB::table('lesson_student')
                ->where('is_completed', true)
                ->whereBetween('updated_at', [$mStart, $mEnd])
                ->count();
        }

        // Top courses by enrollments (course_student)
        $top = DB::table('course_student')
            ->select('course_id', DB::raw('count(*) as total'))
            ->groupBy('course_id')
            ->orderByDesc('total')
            ->limit(4)
            ->get();

        $topCourses = collect($top)->map(function ($row) {
            $course = Course::find($row->course_id);
            return [
                'id' => $row->course_id,
                'title' => $course ? $course->title : 'Không xác định',
                'total' => $row->total,
            ];
        })->toArray();

        // Small stats
        $avgCompletion = (int) round(DB::table('course_student')->avg('progress') ?? 0);
        $activeStudents = DB::table('lesson_student')
            ->where('updated_at', '>=', Carbon::now()->subDays(30))
            ->distinct()
            ->count('student_id');
        $template = 'backend.admin.dashboard.index';
        return view('backend.admin.master', compact(
            'template',
            'totalStudents',
            'totalTeachers',
            'totalCourses',
            'totalQuizzes'
        ))->with([
            'months' => $months,
            'newStudents' => $newStudents,
            'completedLessons' => $completedLessons,
            'topCourses' => $topCourses,
            'avgCompletion' => $avgCompletion,
            'activeStudents' => $activeStudents,
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form')->with('success', 'Đăng xuất thành công');
    }
}