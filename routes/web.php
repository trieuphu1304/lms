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

// Teacher Controllers
use App\Http\Controllers\Backend\Teacher\TeacherController;

// Student Controllers
use App\Http\Controllers\Backend\StudentController;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizResult;

// Trang login dùng chung cho admin + teacher 
Route::get('/login', [AuthSessionController::class, 'index'])->name('login');
Route::post('/login', [AuthSessionController::class, 'login']);
Route::post('/logout', [AuthSessionController::class, 'logout'])->name('logout');

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
    Route::put('/admin/account/update/{id}', [AccountController::class, 'update'])
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
    Route::put('/admin/course/update/{id}', [CourseController::class, 'update'])
        ->name('admin.course.update');
    Route::delete('/admin/course/delete/{id}', [CourseController::class, 'delete'])
        ->name('admin.course.delete');

    // Quản lý bài học
    Route::get('/admin/lesson', [LessonController::class, 'index'])
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
    Route::get('/admin/quiz_result/{id}', [QuizResultController::class, 'show'])
        ->name('admin.quiz_result.show');

});
// Route teacher
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])
        ->name('teacher.dashboard');
});