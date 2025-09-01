<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::view('/welcome', 'welcomepage.welcome');
Route::view('/index', 'aboutpage.index');
Route::view('/achievements', 'aboutpage.achievements');
Route::view('/events', 'aboutpage.events');

// Application form
Route::get('/apply', [ApplicationController::class, 'create'])->name('application.create');
Route::post('/apply', [ApplicationController::class, 'store'])->name('application.store');
Route::view('/apply/show', 'application.show');

// Admin pages (protected)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'admin.dashboard.index')->name('dashboard');
    Route::view('/student-list', 'admin.studentlists.index')->name('student.list');
    Route::get('/applicants', [ApplicationController::class, 'index'])->name('applicants.list');
    Route::get('/applicants/{application}', [ApplicationController::class, 'show'])->name('applicants.show');
    Route::view('/reports', 'admin.reports.index')->name('reports.list');
    Route::post('/student-list/add/{id}', [\App\Http\Controllers\StudentListController::class, 'add'])->name('studentlist.add');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Redirect root URL to login page
    Route::get('/', function () {
        return redirect()->route('login');
        });
    });

// Resource route for applications (for admin CRUD)
Route::resource('applications', ApplicationController::class);

require __DIR__.'/auth.php';