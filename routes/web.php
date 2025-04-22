<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\GradeController;
use App\Http\Controllers\Teacher\ResourceController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use Illuminate\Support\Facades\Route;

//Profile settings
Route::view('/profileSettings', 'global.profile_settings.profileSettings')->name('global.profile_settings.profileSettings');
Route::view('/profilesecurity', 'global.profile_settings.security')->name('global.profile_settings.security');
Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/password', [ProfileController::class, 'passwordUpdate'])->name('profile.pass');

//Home and login
Route::view('/', 'authentification.login');
Route::post('/auth/login', [SessionController::class, 'login'])->name('login');
Route::post('/logout', [SessionController::class, 'logout'])->name('logout');

//Admin
Route::prefix('Admin')->middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::view('/importData', 'admin.importData')->name('admin.importData');

    Route::get('/planning/events', [ScheduleController::class, 'events']);

    Route::get('/planning', [ScheduleController::class, 'index'])->name('admin.planningPage');
    Route::post('/planning', [ScheduleController::class, 'store'])->name('admin.planningPage.store');
    Route::put('/planning/{id}', [ScheduleController::class, 'update']);
    Route::delete('/planning/{planning}', [ScheduleController::class, 'destroy'])->name('admin.planningPage.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('admin.usersPage');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/users/{user}/assignments', [UserController::class, 'getTeacherAssignments']);

    Route::post('/import/preview', [ImportController::class, 'previewImport'])->name('admin.import.preview');
    Route::post('/import/process', [ImportController::class, 'processImport'])->name('admin.import.process');

    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('admin.reports.generate');
});

//Teacher
Route::prefix('Teacher')->middleware(['auth', 'role:Teacher'])->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/grades', [GradeController::class, 'index'])->name('teacher.grades');
    Route::view('/attendance', 'teacher.attendance')->name('teacher.attendance');
    Route::get('/resource', [ResourceController::class, 'index'])->name('teacher.resource');

    Route::get('/attendance/classes/{day}', [AttendanceController::class, 'getClassesForDay']);
    Route::get('/attendance/students/{classroom_id}', [AttendanceController::class, 'getStudents']);
    Route::post('/attendance/submit', [AttendanceController::class, 'submitAttendance']);

    Route::get('/grades/classroom/{classroomId}/students', [GradeController::class, 'getClassroomStudents']);
    Route::get('/grades/classroom/{classroomId}/exams', [GradeController::class, 'getExamAssignments']);
    Route::post('/grades/exams', [GradeController::class, 'createExamAssignment']);
    Route::get('/grades/exams/{examId}', [GradeController::class, 'getGrades']);
    Route::post('/grades/exams/{examId}/submit', [GradeController::class, 'submitGrades']);

    Route::post('/resource', [ResourceController::class, 'store'])->name('teacher.resource.store');
    Route::get('/resource/{id}', [ResourceController::class, 'show'])->name('teacher.resource.show');
    Route::put('/resource/{id}', [ResourceController::class, 'update'])->name('teacher.resource.update');
    Route::delete('/resource/{id}', [ResourceController::class, 'destroy'])->name('teacher.resource.delete');
    Route::get('/resource/{id}/download', [ResourceController::class, 'download'])->name('teacher.resource.download');
});

//Student
Route::prefix('Student')->middleware(['auth', 'role:Student'])->group(function () {
    Route::view('/attendance', 'student.attendance')->name('student.attendance');
    Route::view('/grades', 'student.grades')->name('student.grades');
    Route::view('/resource', 'student.resources')->name('student.resources');

    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
});