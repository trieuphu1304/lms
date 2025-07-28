<?php

namespace App\Http\Controllers\Frontend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Quiz;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class CourseDetailController extends Controller
{
    public function index($id)
    {
        // Lấy thông tin khóa học (gồm teacher, category)
        $course = Course::with(['teacher', 'category', 'reviews'])->findOrFail($id);

        // Lấy các section của khóa học và đếm số bài giảng trong mỗi section
        $sections = Section::withCount('lessons')
            ->where('course_id', $id)
            ->get();

        // Lấy bài giảng của khóa học
        $lessons = Lesson::where('course_id', $id)->get();

        // Lấy danh sách các cấp độ
        $levels = Course::select('level')->distinct()->pluck('level', 'level');

        // Lấy danh mục (giới hạn 6)
        $categories = Category::withCount('courses')->latest()->take(6)->get();

        // Lấy các khóa học khác của giáo viên (trừ khóa hiện tại)
        $otherCourses = Course::with('reviews') // Load reviews
            ->where('teacher_id', $course->teacher_id)
            ->where('id', '!=', $course->id)
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($course) {
                // Gán giá trị ratings trung bình để dùng ở view
                $course->ratings = round($course->reviews->avg('rating'), 1) ?? 0;
                return $course;
            });


        // Tổng số học viên của giáo viên (duy nhất)
        $totalStudents = DB::table('course_student')
            ->join('courses', 'course_student.course_id', '=', 'courses.id')
            ->where('courses.teacher_id', $course->teacher_id)
            ->distinct('course_student.student_id')
            ->count('course_student.student_id');

        // Tổng số học viên của khóa hiện tại
        $courseStudents = DB::table('course_student')
            ->where('course_id', $id)
            ->count();

        // Tổng số khóa học của giáo viên
        $totalCourses = Course::where('teacher_id', $course->teacher_id)->count();

        // Tổng số câu hỏi kiểm tra
        $totalQuizzes = Quiz::count();

        // Tổng số tài liệu bài học
        $totalDocuments = Lesson::where('course_id', $id)
            ->whereNotNull('document_url')
            ->where('document_url', '!=', '')
            ->count();

        // Tính điểm trung bình đánh giá
        $averageRating = $course->reviews->avg('rating');
        $totalReviews = $course->reviews->count();

        // Tính số lượng và phần trăm mỗi mức đánh giá
        $starCounts = $course->reviews()
            ->select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')
            ->pluck('total', 'rating')
            ->toArray();

        $ratings = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $starCounts[$i] ?? 0;
            $percent = $totalReviews > 0 ? round($count / $totalReviews * 100) : 0;
            $ratings[$i] = [
                'count' => $count,
                'percent' => $percent,
            ];
        }
        $ratingBreakdown = [];
        foreach ($ratings as $star => $data) {
            $ratingBreakdown[$star] = $data['count'];
        }

        $reviews = Review::where('course_id', $id)->latest()->paginate(5);

        $user = $course->teacher;

        $template = 'frontend.course.detail';

        return view('frontend.master', compact(
            'template',
            'course',
            'lessons',
            'sections',
            'totalStudents',
            'totalCourses',
            'user',
            'totalQuizzes',
            'totalDocuments',
            'courseStudents',
            'categories',
            'levels',
            'otherCourses',
            'averageRating',
            'totalReviews',
            'ratings',
            'ratingBreakdown',
            'reviews'
        ));
    }
}