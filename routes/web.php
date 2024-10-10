<?php

use App\Http\Controllers\DaftarKasusController;
use App\Http\Controllers\ProfileController;
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
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/daftar-kasus', [DaftarKasusController::class, 'index'])->name('daftarKasus');
    Route::get('/tambah-kasus', [DaftarKasusController::class, 'create'])->name('daftarKasus.create');
    Route::post('/daftarKasus', [DaftarKasusController::class, 'store'])->name('daftarKasus.store');
    Route::put('/daftarKasus/{id}', [DaftarKasusController::class, 'update'])->name('daftarKasus.update');
});

require __DIR__.'/auth.php';
