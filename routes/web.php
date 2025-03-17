<?php

use Illuminate\Support\Facades\Route;

Route::view('/profileSettings', 'global.profile_settings.profileSettings')->name('global.profile_settings.profileSettings');
Route::view('/profilesecurity', 'global.profile_settings.security')->name('global.profile_settings.security');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/importData', 'admin.importData')->name('admin.importData');
    Route::view('/planning', 'admin.planningPage')->name('admin.planningPage');
    Route::view('/users', 'admin.usersPage')->name('admin.usersPage');
});

Route::view('/dashboard', 'teacher.dashboard')->name('teacher.dashboard');
Route::view('/attendance', 'teacher.attendance')->name('teacher.attendance');