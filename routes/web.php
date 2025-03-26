<?php

use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/profileSettings', 'global.profile_settings.profileSettings')->name('global.profile_settings.profileSettings');
Route::view('/profilesecurity', 'global.profile_settings.security')->name('global.profile_settings.security');

Route::view('/login', 'authentification.login');
Route::post('/auth/login', [SessionController::class, 'login'])->name('login');
Route::post('/logout', [SessionController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/importData', 'admin.importData')->name('admin.importData');
    Route::view('/planning', 'admin.planningPage')->name('admin.planningPage');
    Route::view('/users', 'admin.usersPage')->name('admin.usersPage');

    Route::post('/import/preview', [ImportController::class, 'previewImport'])->name('admin.import.preview');
    Route::post('/import/process', [ImportController::class, 'processImport'])->name('admin.import.process');
});

Route::prefix('teacher')->middleware(['auth', 'teacher'])->group(function () {
    Route::view('/dashboard', 'teacher.dashboard')->name('teacher.dashboard');
    Route::view('/attendance', 'teacher.attendance')->name('teacher.attendance');
    Route::view('/grades', 'teacher.grades')->name('teacher.grades');
    Route::view('/resource', 'teacher.resource')->name('teacher.resource');
});

Route::prefix('student')->middleware(['auth', 'student'])->group(function () {
    Route::view('/dashboard', 'student.dashboard')->name('student.dashboard');
    Route::view('/attendance', 'student.attendance')->name('student.attendance');
    Route::view('/grades', 'student.grades')->name('student.grades');
    Route::view('/resource', 'student.resources')->name('student.resources');
});