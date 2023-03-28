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
    Route::get('/profile/{student}/your-classes', [StudyClassController::class, 'studentClasses'])->name('your-classes');
    Route::get('/classes/discover', [StudyClassController::class, 'discoverClasses'])->name('discover-class.index');
    Route::get('/classes/{studyClass}/open', [StudyClassController::class, 'openEnrolledClass'])->name('class-study.open-enrolled-class');
    Route::get('/classes/{studyClass}/enroll', [ClassRegistrationController::class, 'enroll'])->name('class.enroll');
    Route::get('/classes/{studyClass}/cancel-enroll', [ClassRegistrationController::class, 'cancelEnroll'])->name('class.cancel-enroll');
    //Admin & Staff
    Route::resource('/study-class', StudyClassController::class)->except('show');
    Route::get('/study-class/{studyClass}/toggle', [StudyClassController::class, 'toggle'])->name('study-class.toggle');
    Route::get('/study-class/{studyClass}/manage-students', [StudyClassController::class, 'manageStudents'])->name('study-class.manage-students');
    Route::resource('/students', StudentController::class)->except('show');
    Route::get('/students/{student}/manage-classes', [StudentController::class, 'manageClass'])->name('students.manage-class');
    Route::resource('/class-registration', ClassRegistrationController::class)->except(['show', 'create', 'update']);
    Route::post('/class-registration/{classRegistration}/accept', [ClassRegistrationController::class, 'accept'])->name('class-registration.accept');
    Route::post('/class-registration/{classRegistration}/decline', [ClassRegistrationController::class, 'decline'])->name('class-registration.decline');
});

require __DIR__ . '/auth.php';
