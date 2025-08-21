<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

Route::get('/welcome', function () {
    return view('welcomepage.welcome');
});

Route::get('/index', function () {
    return view('aboutpage.index');
});

Route::get('/achievements', function () {
    return view('aboutpage.achievements');
});

Route::get('/events', function () {
    return view('aboutpage.events');
});

Route::get('/apply/thankyou', function () {
    return view('application.thankyou');
});

Route::get('/apply', [ApplicationController::class, 'create'])->name('application.create');
Route::post('/apply', [ApplicationController::class, 'store'])->name('application.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
