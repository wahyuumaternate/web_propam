<?php

use App\Http\Controllers\ArtisanRunnerController;
use App\Http\Controllers\DaftarKasusController;
use App\Http\Controllers\KategoriController;
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
    // artisan call
    Route::get('/migrate', [ArtisanRunnerController::class, 'migrateFresh']);
    Route::get('/link', [ArtisanRunnerController::class, 'link']);
    Route::get('/cache', [ArtisanRunnerController::class, 'cache']);
    // 
    Route::get('/daftar-kasus', [DaftarKasusController::class, 'index'])->name('daftarKasus');
    Route::get('/daftar-kasus/tambah-kasus', [DaftarKasusController::class, 'create'])->name('daftarKasus.create');
    Route::post('/daftarKasus', [DaftarKasusController::class, 'store'])->name('daftarKasus.store');
    Route::put('/daftarKasus/{id}', [DaftarKasusController::class, 'update'])->name('daftarKasus.update');
    // kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


});

require __DIR__.'/auth.php';
