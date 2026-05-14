<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/verify-registration-otp', [AuthController::class, 'verifyRegistrationOtp'])->name('register.otp');
Route::post('/resend-registration-otp', [AuthController::class, 'resendRegistrationOtp'])->name('register.resend');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/login-otp', [AuthController::class, 'sendLoginOtp'])->name('login.otp.send');
Route::post('/verify-login-otp', [AuthController::class, 'verifyLoginOtp'])->name('login.otp.verify');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('password.email');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('password.otp');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user && $user->role === 'admin') {
        return view('hospital.dashboard', ['hospital' => $user->hospital]);
    }
    return view('patient.dashboard');
})->middleware('auth')->name('dashboard');

use App\Http\Controllers\OpdQueueController;
Route::get('/opd-queue', [OpdQueueController::class, 'index'])->name('opd-queue');

Route::get('/bed-map', function () {
    $user = auth()->user();
    $hospital = $user && $user->hospital_id ? $user->hospital : null;
    return view('hospital.bed-map', compact('hospital'));
})->middleware('auth')->name('bed-map');

Route::get('/admissions', function () {
    $user = auth()->user();
    $hospital = $user && $user->hospital_id ? $user->hospital : null;
    return view('hospital.admissions', compact('hospital'));
})->middleware('auth')->name('admissions');

Route::get('/inventory', function () {
    $user = auth()->user();
    $hospital = $user && $user->hospital_id ? $user->hospital : null;
    return view('hospital.inventory', compact('hospital'));
})->middleware('auth')->name('inventory');

Route::get('/doctor-schedule', function () {
    $user = auth()->user();
    $hospital = $user && $user->hospital_id ? $user->hospital : null;
    return view('hospital.doctor-schedule', compact('hospital'));
})->middleware('auth')->name('doctor-schedule');

Route::get('/wait-board', function () {
    $user = auth()->user();
    $hospital = $user && $user->hospital_id ? $user->hospital : null;
    return view('hospital.wait-board', compact('hospital'));
})->middleware('auth')->name('wait-board');

use App\Http\Controllers\CityBedsController;
Route::get('/city-beds', [CityBedsController::class, 'index'])->name('city-beds');
Route::get('/hospital/{id}', [CityBedsController::class, 'show'])->name('hospital.show');
Route::post('/hospital/{id}/book-bed', [CityBedsController::class, 'bookBed'])->name('hospital.book-bed');
Route::post('/hospital/update-status', [CityBedsController::class, 'updateStatus'])->name('hospital.update-status')->middleware('auth');

Route::get('/patients', function () {
    return view('placeholder', ['title' => 'Patients Portal']);
})->name('patients');

Route::get('/hospitals', function () {
    return view('placeholder', ['title' => 'Hospitals Network']);
})->name('hospitals');

Route::get('/find-doctor', function () {
    return view('placeholder', ['title' => 'Find a Doctor']);
})->name('find-doctor');

Route::get('/profile', function () {
    return view('placeholder', ['title' => 'My Account']);
})->name('profile');

Route::get('/settings', function () {
    return view('placeholder', ['title' => 'Settings']);
})->name('settings');

Route::get('/support', function () {
    return view('placeholder', ['title' => 'Help & Support']);
})->name('support');

use App\Http\Controllers\AppointmentController;
Route::get('/my-appointments', [AppointmentController::class, 'index'])->name('my-appointments');
Route::get('/my-appointments/book', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/my-appointments/book', [AppointmentController::class, 'store'])->name('appointments.store');
Route::post('/my-appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
Route::post('/my-appointments/{id}/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');

use App\Http\Controllers\MedicalRecordController;
Route::get('/medical-records', [MedicalRecordController::class, 'index'])->name('medical-records');
Route::post('/medical-records/upload', [MedicalRecordController::class, 'store'])->name('medical-records.store');
