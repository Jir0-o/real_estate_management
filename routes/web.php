<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AsignTaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginDetailsController;
use App\Http\Controllers\ManageWorkController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectTitleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkPlanController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('homeland.about');
})->name('about');

Route::get('/buy', function () {
    return view('homeland.buy');
})->name('buy');

Route::get('/contact', function () {
    return view('homeland.contact');
})->name('contact');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::resource('dashboard', DashboardController::class);
    Route::resource('user', UserController::class);
    Route::resource('roles', RoleController::class);
    
});
