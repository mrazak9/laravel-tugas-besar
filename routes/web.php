<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
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


Route::get('/', function () {
    return view('pages.auth.auth-login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.app.dashboard-siakad', ['type_menu' => '']);
    })->name('home');
});

// resource route for subject with middleware auth
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('user', UserController::class);

    Route::post('users/import', [UserController::class, 'import'])->name('users.import');
    Route::resource('subject', SubjectController::class);

    Route::post('subjects/import', [SubjectController::class, 'import'])->name('subjects.import');
});

// resource route for schedule with middleware auth
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('schedule', ScheduleController::class);

    Route::post('schedules/import', [ScheduleController::class, 'import'])->name('schedules.import');
    Route::post('schedules/import-schedule', [ScheduleController::class, 'importSchedule'])->name('schedules.importStudent');
});

// get route for generate qrcode with param schedule and with middleware auth
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('generate-qrcode/{schedule}', [ScheduleController::class, 'generateQrCode'])->name('generate-qrcode');
});

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('generate-qrcode', [ScheduleController::class, 'generateQrCode'])->name('generate-qrcode');
// });

// put route for generate qrcode with middleware auth
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::put('generate-qrcode-update/{schedule}', [ScheduleController::class, 'generateQrCodeUpdate'])->name('generate-qrcode-update');
});
