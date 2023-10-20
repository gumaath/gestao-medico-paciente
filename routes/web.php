<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ProfileController;
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

    Route::resource('dashboard', AppointmentController::class)
        ->only(['index'])
        ->middleware(['auth', 'verified'])->name('index', 'dashboard');

    Route::resource('appointments', AppointmentController::class)
        ->only(['store', 'edit', 'update', 'destroy'])
        ->middleware(['auth', 'verified']);

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';

    Route::get('/resource/medic', [ResourceController::class, 'medic'])->name('index.medic');
    Route::get('/resource/patient', [ResourceController::class, 'patient'])->name('index.patient');
    Route::get('/resource/specialty', [ResourceController::class, 'specialty'])->name('index.specialty');
    Route::get('/resource/admin', [ResourceController::class, 'admin'])->name('index.admin');



    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
});
