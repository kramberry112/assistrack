<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::view('/welcome', 'welcomepage.welcome');
Route::view('/index', 'aboutpage.index');
Route::view('/news', 'aboutpage.news');
Route::view('/events', 'aboutpage.events');
Route::view('/contact', 'contactus.index');

// Application form
Route::get('/apply', [ApplicationController::class, 'create'])->name('application.create');
Route::post('/apply', [ApplicationController::class, 'store'])->name('application.store');
Route::view('/apply/show', 'application.show');


// Admin pages (protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/admindashboard', 'admin.dashboard.index')->name('Admin');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardRedirectController::class, 'redirect'])->name('dashboard');
    Route::get('/student-list', [\App\Http\Controllers\StudentListController::class, 'index'])->name('student.list');
    Route::get('/students/{student}', [\App\Http\Controllers\StudentListController::class, 'show'])->name('students.show');
    Route::delete('/students/{student}', [\App\Http\Controllers\StudentListController::class, 'destroy'])->name('students.delete');
    Route::get('/applicants', [ApplicationController::class, 'index'])->name('applicants.list');
    Route::get('/applicants/{application}', [ApplicationController::class, 'show'])->name('applicants.show');
    Route::view('/reports', 'admin.reports.index')->name('reports.list');
    Route::post('/student-list/add/{id}', [\App\Http\Controllers\StudentListController::class, 'add'])->name('studentlist.add');
    Route::patch('/students/{student}/office', [\App\Http\Controllers\StudentListController::class, 'updateOffice'])->name('students.updateOffice');
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Community join
    Route::post('/community/join', [\App\Http\Controllers\CommunityGroupController::class, 'join'])->name('community.join');
    // Redirect root URL to login page
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

// Head Office pages (protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/headdashboard', 'headoffice.dashboard.index')->name('Head');
    Route::get('/head-student-list', [\App\Http\Controllers\HeadStudentListController::class, 'index'])->name('head.student.list');
    Route::view('/head-reports', 'headoffice.reports.index')->name('head.reports.list');
    Route::view('/head-reports-alt', 'headoffice.reports.index')->name('head.reports');
    Route::get('/head-students/{student}', [\App\Http\Controllers\HeadStudentListController::class, 'show'])->name('head.students.show');
});

// Student pages (protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/studentdashboard', [\App\Http\Controllers\StudentTaskController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/student-tasks/{id}/status', [\App\Http\Controllers\StudentTaskController::class, 'updateStatus'])->name('student.tasks.status');
    Route::post('/student-tasks/{id}/progress', [\App\Http\Controllers\StudentTaskController::class, 'updateProgress'])->name('student.tasks.progress');
    Route::get('/student-community', [\App\Http\Controllers\CommunityGroupController::class, 'index'])->name('student.community');
    Route::post('/student-community', [\App\Http\Controllers\CommunityGroupController::class, 'store'])->name('student.community.create');
    Route::post('/community/send-message', [App\Http\Controllers\CommunityGroupController::class, 'sendMessage'])->name('community.sendMessage');
    Route::view('/student-calendar', 'students.calendar.index')->name('student.calendar');
    Route::view('/student-tasks/create', 'students.dashboard.create')->name('student.tasks.create');
    Route::post('/student-tasks', [\App\Http\Controllers\StudentTaskController::class, 'store'])->name('student.tasks.store');
    // Add more student routes here as needed
});

// Resource route for applications (for admin CRUD)
Route::resource('applications', ApplicationController::class);

require __DIR__.'/auth.php';