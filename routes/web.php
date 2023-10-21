<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['splade'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    // Authentication routes
    require __DIR__ . '/auth.php';

    // Dashboard route
    Route::resource('dashboard', AppointmentController::class)
        ->only(['index'])
        ->middleware(['auth', 'verified'])
        ->name('index', 'dashboard');

    // Appointment routes
    Route::resource('appointments', AppointmentController::class)
        ->only(['store', 'edit', 'update', 'destroy'])
        ->middleware(['auth', 'verified']);

    // Profile routes
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Resource routes for admin
    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('/resource/medic', [ResourceController::class, 'medic'])->name('index.medic');
        Route::get('/resource/patient', [ResourceController::class, 'patient'])->name('index.patient');
        Route::get('/resource/specialty', [ResourceController::class, 'specialty'])->name('index.specialty');
        Route::get('/resource/admin', [ResourceController::class, 'admin'])->name('index.admin');
        Route::get('/resource/appointment', [ResourceController::class, 'appointment'])->name('index.appointment');

        // Registration routes for different user types
        Route::post('register/patient', [TypeController::class, 'patient'])->name('register.patient');
        Route::post('register/admin', [TypeController::class, 'admin'])->name('register.admin');
        Route::post('register/specialty', [SpecialtyController::class, 'store'])->name('register.speciality');
        Route::post('register/medic', [TypeController::class, 'medic'])->name('register.medic');
        Route::post('register/appointment', [AppointmentController::class, 'store'])->name('register.appointment');
    });

    // Additional routes
    Route::post('/check-patient-birthdate', [PatientController::class, 'checkPatientBirthdate']);
    Route::post('/search-pediatric-medics', [MedicController::class, 'searchPediatricMedics']);

    // Registers routes for various features and components
    Route::spladeWithVueBridge(); // Interactive components
    Route::spladePasswordConfirmation(); // Password confirmation
    Route::spladeTable(); // Table Bulk Actions and Exports
    Route::spladeUploads(); // Async File Uploads with Filepond
});
