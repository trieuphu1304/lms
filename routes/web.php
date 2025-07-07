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
use App\Http\Controllers\Backend\Teacher\QuestionController as TeacherQuestionController;
use App\Http\Controllers\Backend\Teacher\ResultController as TeacherResultController;
use App\Http\Controllers\Backend\Teacher\ProfileController as TeacherProfileController;
use App\Http\Controllers\Backend\Teacher\FeedbackController as TeacherFeedbackController;
use App\Http\Controllers\Backend\Teacher\NotificationController as TeacherNotificationController;
use App\Http\Controllers\Backend\Teacher\ScheduleController as TeacherScheduleController;


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

    // Quản lí bài kiểm tra
    Route::get('/lesson/{lesson}/quizzes', [TeacherQuizController::class, 'index'])->name('teacher.lesson.quizzes');
    Route::get('/quiz/create/{lesson}', [TeacherQuizController::class, 'create'])->name('teacher.quiz.create');
    Route::post('/quiz/store', [TeacherQuizController::class, 'store'])->name('teacher.quiz.store');
    Route::get('/quiz/edit/{id}', [TeacherQuizController::class, 'edit'])->name('teacher.quiz.edit');
    Route::put('/quiz/update/{id}', [TeacherQuizController::class, 'update'])->name('teacher.quiz.update');
    Route::delete('/quiz/delete/{id}', [TeacherQuizController::class, 'delete'])->name('teacher.quiz.delete');

    //Quản lí câu hỏi
    Route::get('/quiz/{quiz}/questions', [TeacherQuestionController::class, 'index'])->name('teacher.question');
    Route::get('/{quiz}/create', [TeacherQuestionController::class, 'create'])->name('teacher.question.create');
    Route::post('/store', [TeacherQuestionController::class, 'store'])->name('teacher.question.store');
    Route::get('/edit/{id}', [TeacherQuestionController::class, 'edit'])->name('teacher.question.edit');
    Route::put('/update/{id}', [TeacherQuestionController::class, 'update'])->name('teacher.question.update');
    Route::delete('/delete/{id}', [TeacherQuestionController::class, 'delete'])->name('teacher.question.delete');

    //Quản lí điểm
    Route::get('/teacher/quiz-results', [TeacherResultController::class, 'allResults'])->name('teacher.quiz_results.index');
    Route::get('/quiz/{quiz}/results', [TeacherResultController::class, 'quizResults'])->name('teacher.quiz_results.by_quiz');

    //Quản lí thông tin
    Route::get('/profile', [TeacherProfileController::class, 'index'])->name('teacher.profile');
    Route::get('/profile/edit', [TeacherProfileController::class, 'edit'])->name('teacher.profile.edit');
    Route::post('/profile/update', [TeacherProfileController::class, 'update'])->name('teacher.profile.update');
    Route::get('/change-password', [TeacherProfileController::class, 'changePassword'])->name('teacher.change_password');
    Route::post('/change-password', [TeacherProfileController::class, 'updatePassword'])->name('teacher.update_password');

    //Quản lí phản hồi
    Route::get('/teacher/feedback', [TeacherFeedbackController::class, 'index'])->name('teacher.feedback');
    Route::get('/teacher/feedback/{id}', [TeacherFeedbackController::class, 'show'])->name('teacher.feedback.show');
    Route::delete('/teacher/feedback/delete/{id}', [TeacherFeedbackController::class, 'delete'])->name('teacher.feedback.delete');
    //Quản lí thông báo
    Route::get('/teacher/notifications', [TeacherNotificationController::class, 'index'])->name('teacher.notifications.index');
    Route::delete('/teacher/notifications', [TeacherNotificationController::class, 'destroyAll'])->name('teacher.notifications.delete_all');

    //Quản lí lịch học
    Route::get('/teacher/schedules', [TeacherScheduleController::class, 'index'])->name('teacher.schedule');
    Route::get('/teacher/schedules/create', [TeacherScheduleController::class, 'create'])->name('teacher.schedule.create');
    Route::post('/schedules/store', [TeacherScheduleController::class, 'store'])->name('teacher.schedule.store');
    Route::get('/schedules/edit/{id}', [TeacherScheduleController::class, 'edit'])->name('teacher.schedule.edit');
    Route::put('/schedules/update/{id}', [TeacherScheduleController::class, 'update'])->name('teacher.schedule.update');
    Route::delete('/schedules/delete/{id}', [TeacherScheduleController::class, 'destroy'])->name('teacher.schedule.delete');
});