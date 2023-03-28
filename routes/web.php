<?php

use App\Http\Controllers\ClassRegistrationController;
use App\Http\Controllers\DiscoverClassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyClassController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole(['super_admin', 'staff'])) {
        return view('admin-dashboard');
    } else {
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Student
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/discover-classes', [StudyClassController::class, 'discoverClasses'])->name('discover-class.index');
    Route::get('profile/{student}/your-classes', [StudyClassController::class, 'studentClasses'])->name('your-classes');
    //Admin & Staff
    Route::resource('/study-class', StudyClassController::class)->except('show');
    Route::get('/study-class/{studyClass}/toggle', [StudyClassController::class, 'toggle'])->name('study-class.toggle');
    Route::get('/study-class/{studyClass}/manage-students', [StudyClassController::class, 'manageStudents'])->name('study-class.manage-students');
    Route::resource('/students', StudentController::class)->except('show');
    Route::get('/students/{student}/manage-classes', [StudentController::class, 'manageClass'])->name('students.manage-class');
    Route::resource('/class-registration', ClassRegistrationController::class)->except('show');
});

require __DIR__ . '/auth.php';
