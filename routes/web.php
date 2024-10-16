<?php

use App\Http\Controllers\ArtisanRunnerController;
use App\Http\Controllers\DaftarKasusController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\StatusController;
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
    // pangkat
    Route::get('/pangkat', [PangkatController::class, 'index'])->name('pangkat');
    Route::post('/pangkat', [PangkatController::class, 'store'])->name('pangkat.store');
    Route::put('/pangkat/{id}', [PangkatController::class, 'update'])->name('pangkat.update');
    Route::delete('/pangkat/{id}', [PangkatController::class, 'destroy'])->name('pangkat.destroy');
    // satker
    Route::get('/satker-satwil', [SatkerController::class, 'index'])->name('satker');
    Route::post('/satker', [SatkerController::class, 'store'])->name('satker.store');
    Route::put('/satker/{id}', [SatkerController::class, 'update'])->name('satker.update');
    Route::delete('/satker/{id}', [SatkerController::class, 'destroy'])->name('satker.destroy');
    // status
    Route::get('/status', [StatusController::class, 'index'])->name('status');
    Route::post('/status', [StatusController::class, 'store'])->name('status.store');
    Route::put('/status/{id}', [StatusController::class, 'update'])->name('status.update');
    Route::delete('/status/{id}', [StatusController::class, 'destroy'])->name('status.destroy');


});

require __DIR__.'/auth.php';
