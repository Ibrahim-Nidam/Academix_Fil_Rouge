<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Teacher\AttendanceController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\User\UserController;
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

    Route::post('/import/preview', [ImportController::class, 'previewImport'])->name('admin.import.preview');
    Route::post('/import/process', [ImportController::class, 'processImport'])->name('admin.import.process');
});

//Teacher
Route::prefix('Teacher')->middleware(['auth', 'role:Teacher'])->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/grades', [GradeController::class, 'index'])->name('teacher.grades');
    Route::view('/attendance', 'teacher.attendance')->name('teacher.attendance');
    Route::view('/grades', 'teacher.grades')->name('teacher.grades');
    Route::view('/resource', 'teacher.resource')->name('teacher.resource');

    Route::get('/attendance/classes/{day}', [AttendanceController::class, 'getClassesForDay']);
    Route::get('/attendance/students/{classroom_id}', [AttendanceController::class, 'getStudents']);
    Route::post('/attendance/submit', [AttendanceController::class, 'submitAttendance']);
    Route::get('/grades/classroom/{classroomId}/students', [GradeController::class, 'getClassroomStudents']);
});

//Student
Route::prefix('Student')->middleware(['auth', 'role:Student'])->group(function () {
    Route::view('/dashboard', 'student.dashboard')->name('student.dashboard');
    Route::view('/attendance', 'student.attendance')->name('student.attendance');
    Route::view('/grades', 'student.grades')->name('student.grades');
    Route::view('/resource', 'student.resources')->name('student.resources');
});