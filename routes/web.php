<?php

use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
Route::view('/importData', 'admin.importData')->name('admin.importData');
Route::view('/planning', 'admin.planningPage')->name('admin.planningPage');
Route::view('/users', 'admin.usersPage')->name('admin.usersPage');