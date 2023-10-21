<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MedicController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
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

    Route::get('/resource/medic', [ResourceController::class, 'medic'])->middleware(['auth', 'verified', 'admin'])->name('index.medic');
    Route::get('/resource/patient', [ResourceController::class, 'patient'])->middleware(['auth', 'verified', 'admin'])->name('index.patient');
    Route::get('/resource/specialty', [ResourceController::class, 'specialty'])->middleware(['auth', 'verified', 'admin'])->name('index.specialty');
    Route::get('/resource/admin', [ResourceController::class, 'admin'])->middleware(['auth', 'verified', 'admin'])->name('index.admin');
    Route::get('/resource/appointment', [ResourceController::class, 'appointment'])->middleware(['auth', 'verified', 'admin'])->name('index.appointment');

    Route::post('register/patient', function (Request $request) {
        // Call the store method of RegisteredUserController
        $user_id = app(RegisteredUserController::class)->store($request);

        $request->validate([
            'cpf' => ['required', 'string', 'max:14'],
            'telephones' => ['required'],
            'cep' => ['required', 'string', 'max:8'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        // Call a method from AnotherController
        $redirect = app(TypeController::class)->patient($user_id, $request);

        return $redirect;
    })->middleware(['auth', 'verified', 'admin'])->name('register.patient');

    Route::post('register/admin', function (Request $request) {
        $redirect = app(TypeController::class)->admin($request);

        return $redirect;
    })->middleware(['auth', 'verified', 'admin'])->name('register.admin');

    Route::post('register/specialty', function (Request $request) {
        $redirect = app(SpecialtyController::class)->store($request);

        return $redirect;
    })->middleware(['auth', 'verified', 'admin'])->name('register.speciality');

    Route::post('register/medic', function (Request $request) {

        $request->validate([
            'crm' => ['required'],
            'specialty' => ['required'],
        ]);

        // Call the store method of RegisteredUserController
        $user_id = app(RegisteredUserController::class)->store($request);

        // Call a method from AnotherController
        $redirect = app(TypeController::class)->medic($user_id, $request);

        return $redirect;

    })->middleware(['auth', 'verified', 'admin'])->name('register.medic');

    Route::post('register/appointment', function (Request $request) {

        // Call a method from AnotherController
        $redirect = app(AppointmentController::class)->store($request);

        return $redirect;

    })->middleware(['auth', 'verified', 'admin'])->name('register.appointment');

    Route::post('/check-patient-birthdate', [PatientController::class, 'checkPatientBirthdate']);
    Route::post('/search-pediatric-medics', [MedicController::class, 'searchPediatricMedics']);


    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
});
