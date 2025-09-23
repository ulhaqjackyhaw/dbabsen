<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController; // 1. Import AttendanceController

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

// 2. Grupkan semua rute yang memerlukan login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute utama dashboard sekarang ditangani oleh AttendanceController@index
    Route::get('/dashboard', [AttendanceController::class, 'index'])->name('dashboard');
    
    // Rute khusus untuk menangani proses import file CSV
    Route::post('/attendances/import', [AttendanceController::class, 'import'])->name('attendances.import');

    // 3. Rute Resource untuk semua fungsi CRUD (Create, Read, Update, Delete)
    // Ini secara otomatis membuat rute untuk:
    // - attendances.index (GET)
    // - attendances.create (GET)
    // - attendances.store (POST)
    // - attendances.show (GET)
    // - attendances.edit (GET)
    // - attendances.update (PUT/PATCH)
    // - attendances.destroy (DELETE)
    Route::resource('attendances', AttendanceController::class);
});


// Rute bawaan Breeze untuk manajemen profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat rute autentikasi (login, register, dll.)
require __DIR__.'/auth.php';
