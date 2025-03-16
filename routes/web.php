<?php

use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
Route::view('/importData', 'admin.importData')->name('admin.importData');