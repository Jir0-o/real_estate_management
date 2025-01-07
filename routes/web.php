<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AsignTaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeTypeController;
use App\Http\Controllers\LoginDetailsController;
use App\Http\Controllers\ManageWorkController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectTitleController;
use App\Http\Controllers\PropertyController;
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
    Route::resource('permission', PermissionController::class);
    Route::resource('property', PropertyController::class);
    Route::resource('type', HomeTypeController::class);

    //Notification Route
    Route::get('/notifications/count', [NotificationController::class, 'notificationCount'])->name('notifications.count');
    Route::delete('/notifications/delete/{id}', [NotificationController::class, 'deleteNotification'])->name('notifications.delete');
    Route::post('/notifications/clear', [NotificationController::class, 'clearNotifications'])->name('notifications.clear');
    Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications.get');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    //Settings Route
    Route::get('/settings',[SettingsController::class, 'index'])->name('settings');

    //property Route
    Route::get('property.list', [PropertyController::class, 'getProperty'])->name('property.list');

    //home type Route
    Route::get('type.list', [HomeTypeController::class, 'getHome'])->name('type.list');
    
});
