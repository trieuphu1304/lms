<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthSessionController;
// Admin Controllers
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\AccountController;
use App\Http\Controllers\Backend\Admin\CourseController;
use App\Http\Controllers\Backend\Admin\LessonController;
use App\Http\Controllers\Backend\Admin\QuizController;
use App\Http\Controllers\Backend\Admin\QuestionController;
use App\Http\Controllers\Backend\Admin\QuizResultController;
use App\Http\Controllers\Backend\Admin\FeedbackController;
use App\Http\Controllers\Backend\Admin\ProfileController;

// Teacher Controllers
use App\Http\Controllers\Backend\Teacher\TeacherController;
use App\Http\Controllers\Backend\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Backend\Teacher\LessonController as TeacherLessonController;
use App\Http\Controllers\Backend\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\Backend\Teacher\QuizController as TeacherQuizController;


// Student Controllers
use App\Http\Controllers\Backend\StudentController;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizResult;

// ------------ Login Routes ------------
Route::get('/admin/login', [AuthSessionController::class, 'showAdminLogin'])->name('admin.login');
Route::get('/teacher/login', [AuthSessionController::class, 'showTeacherLogin'])->name('teacher.login');
Route::post('/login', [AuthSessionController::class, 'login'])->name('login.submit');

Route::post('/admin/logout', [AuthSessionController::class, 'adminLogout'])->name('admin.logout');
Route::post('/teacher/logout', [AuthSessionController::class, 'teacherLogout'])->name('teacher.logout');

Route::get('/login', function () {
    if (request()->is('teacher/*') || str_contains(url()->previous(), 'teacher')) {
        return redirect()->route('teacher.login');
    }
    return redirect()->route('admin.login');
})->name('login');

// Route admin 
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Trang chủ admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Tài khoản
    Route::get('/admin/account', [AccountController::class, 'index'])
        ->name('admin.account');
    Route::get('/admin/account/create', [AccountController::class, 'create'])
        ->name('admin.account.create');
    Route::post('/admin/account/store', [AccountController::class, 'store'])
        ->name('admin.account.store');
    Route::get('/admin/account/edit/{id}', [AccountController::class, 'edit'])
        ->name('admin.account.edit');
    Route::post('/admin/account/update/{id}', [AccountController::class, 'update'])
        ->name('admin.account.update');
    Route::delete('/admin/account/delete/{id}', [AccountController::class, 'delete'])
        ->name('admin.account.delete');
        
    // Quản lý khóa học
    Route::get('/admin/course', [CourseController::class, 'index'])
        ->name('admin.course');
    Route::get('/admin/course/create', [CourseController::class, 'create'])
        ->name('admin.course.create');
    Route::post('/admin/course/store', [CourseController::class, 'store'])
        ->name('admin.course.store');
    Route::get('/admin/course/edit/{id}', [CourseController::class, 'edit'])
        ->name('admin.course.edit');
    Route::post('/admin/course/update/{id}', [CourseController::class, 'update'])
        ->name('admin.course.update');
    Route::delete('/admin/course/delete/{id}', [CourseController::class, 'delete'])
        ->name('admin.course.delete');

    // Quản lý bài học
    Route::get('/admin/lesson/{course}', [LessonController::class, 'index'])
        ->name('admin.lesson');
    Route::delete('/admin/lesson/delete/{id}', [LessonController::class, 'delete'])
        ->name('admin.lesson.delete');

    // Quản lý quiz
    Route::get('/admin/quiz', [QuizController::class, 'index'])
        ->name('admin.quiz');
    Route::delete('/admin/quiz/delete/{id}', [QuizController::class, 'delete'])
        ->name('admin.quiz.delete');
    Route::get('/admin/quiz/{id}', [QuizController::class, 'show'])
        ->name('admin.quiz.show');

    // Quản lý bài kiểm tra
    Route::get('/admin/question/{quizId}', [QuestionController::class, 'index'])
        ->name('admin.question');
    Route::delete('/admin/question/delete/{id}', [QuestionController::class, 'delete'])
        ->name('admin.question.delete');

    // Quản lí kết quả
    Route::get('/admin/quiz_result/{quizId}', [QuizResultController::class, 'index'])
        ->name('admin.quiz_result');
    Route::get('/admin/quiz_result/detail/{id}', [QuizResultController::class, 'show'])
        ->name('admin.quiz_result.detail');

    // Quản lí phản hồi
    Route::get('/admin/feedback', [FeedbackController::class, 'index'])
        ->name('admin.feedback');
    Route::delete('/admin/feedback/delete/{id}', [FeedbackController::class, 'delete'])
        ->name('admin.feedback.delete');
    
    // Quản lí thông tin
    Route::get('/admin/profile', [ProfileController::class, 'index'])
        ->name('admin.profile');
    Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])
        ->name('admin.profile.edit');
    Route::post('/admin/profile/update', [ProfileController::class, 'update'])
        ->name('admin.profile.update');
    Route::get('/admin/profile/password', [ProfileController::class, 'changePassword'])
        ->name('admin.profile.password.change');
    Route::post('/admin/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('admin.profile.password');  


});


// Route teacher
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])
    ->name('teacher.dashboard');

    // Quản lí khóa học
    Route::get('/course', [TeacherCourseController::class, 'index'])->name('teacher.course');
    Route::get('/course/create', [TeacherCourseController::class, 'create'])->name('teacher.course.create');
    Route::post('/course/store', [TeacherCourseController::class, 'store'])->name('teacher.course.store');
    Route::get('/course/edit/{id}', [TeacherCourseController::class, 'edit'])->name('teacher.course.edit');
    Route::put('/course/update/{id}', [TeacherCourseController::class, 'update'])->name('teacher.course.update');
    Route::delete('/course/delete/{id}', [TeacherCourseController::class, 'delete'])->name('teacher.course.delete');

    // Quản lí bài giảng
    Route::get('/teacher/lesson/{course}', [TeacherLessonController::class, 'index'])->name('teacher.lesson');
    Route::get('/lesson/create', [TeacherLessonController::class, 'create'])->name('teacher.lesson.create');
    Route::post('/lesson/store', [TeacherLessonController::class, 'store'])->name('teacher.lesson.store');
    Route::get('/lesson/edit/{id}', [TeacherLessonController::class, 'edit'])->name('teacher.lesson.edit');
    Route::put('/lesson/update/{id}', [TeacherLessonController::class, 'update'])->name('teacher.lesson.update');
    Route::delete('/lesson/delete/{id}', [TeacherLessonController::class, 'delete'])->name('teacher.lesson.delete');

    // Quản lý học viên
    Route::get('/students', [TeacherStudentController::class, 'index'])->name('teacher.students');

    // Quản lí
    Route::get('/quiz/{lesson}', [TeacherQuizController::class, 'index'])->name('teacher.quiz');
    Route::get('/quiz/create/{lesson}', [TeacherQuizController::class, 'create'])->name('teacher.quiz.create');
    Route::post('/quiz/store', [TeacherQuizController::class, 'store'])->name('teacher.quiz.store');
    Route::get('/quiz/edit/{id}', [TeacherQuizController::class, 'edit'])->name('teacher.quiz.edit');
    Route::put('/quiz/update/{id}', [TeacherQuizController::class, 'update'])->name('teacher.quiz.update');
    Route::delete('/quiz/delete/{id}', [TeacherQuizController::class, 'delete'])->name('teacher.quiz.delete');
});