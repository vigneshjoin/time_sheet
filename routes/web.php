<?php
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimesheetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| login authentication middleware applied check below files role checking
    app\Http\Middleware\RedirectIfAuthenticated.php
    app\Providers\RouteServiceProvider.php
    app\Http\Controllers\Admin\AdminAuthController.php

*/

Route::get('/', [AdminAuthController::class, 'login'])->name('admin.login')->middleware('guest');
Route::get('/login', [AdminAuthController::class, 'login']);

// Handle the login form submit (POST)
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');




// app\Providers\RouteServiceProvider.php
Route::middleware('auth')->group(function () {

    // STAFF ROUTES
    Route::middleware('user_type:staff')->group(function () {

        // Users login
        // Timesheet Management Routes
            Route::get('/timesheet', [TimesheetController::class, 'index'])->name('admin.timesheet.index');
            Route::get('/timesheet/list', [TimesheetController::class, 'list'])->name('admin.timesheet.list');
            Route::get('/timesheet/create', [TimesheetController::class, 'create'])->name('admin.timesheet.create');
            Route::post('/timesheet', [TimesheetController::class, 'store'])->name('admin.timesheet.store');
            Route::get('/timesheet/{timesheet}', [TimesheetController::class, 'show'])->name('admin.timesheet.show');
            Route::get('/timesheet/{timesheet}/edit', [TimesheetController::class, 'edit'])->name('admin.timesheet.edit');
            Route::put('/timesheet/{timesheet}', [TimesheetController::class, 'update'])->name('admin.timesheet.update');
            Route::delete('/timesheet/{timesheet}', [TimesheetController::class, 'destroy'])->name('admin.timesheet.destroy');
        // Timesheet Management Routes
    });


    // SUPER ADMIN ROUTES
    Route::middleware('user_type:super_admin,admin')->group(function () {

        // User Management Routes
            Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
            Route::get('/users/list', [UsersController::class, 'list'])->name('admin.users.list');
            Route::get('/users/create', [UsersController::class, 'create'])->name('admin.users.create');
            Route::post('/users', [UsersController::class, 'store'])->name('admin.users.store');
            Route::get('/users/{user}', [UsersController::class, 'show'])->name('admin.users.show');
            Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
            Route::put('/users/{user}', [UsersController::class, 'update'])->name('admin.users.update');
            Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

            Route::get('/admin/timesheet', [TimesheetController::class, 'timesheetlists'])->name('admin.timesheet.adminlist');
            Route::get('/admin/timesheet/{timesheet}/edit', [TimesheetController::class, 'adminEdit'])->name('admin.timesheet.adminEdit');

        // User Management Routes
    });


   


    Route::middleware('user_type:super_admin,admin')->group(function () {

            Route::get('/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
            Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
            Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('admin.projects.show');
            
            Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('admin.projects.update');
            Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');

    });

     Route::middleware('user_type:super_admin,admin,staff')->group(function () {

        // Projects Management Routes
            Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
            Route::get('/projects/list', [ProjectController::class, 'list'])->name('admin.projects.list');
            Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
            Route::put('/projects/status_update/{project}', [ProjectController::class, 'status_update'])->name('admin.projects.status_update');
        // Projects Management Routes
     });

    Route::get('/logout',  [AdminAuthController::class, 'logout']);
    Route::get('/change-password',  [AdminAuthController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('/change-password',  [AdminAuthController::class, 'updatePassword'])->name('admin.change-password');
});

require __DIR__.'/auth.php';
