<?php

use App\Http\Controllers\ArtisanRunnerController;
use App\Http\Controllers\DaftarKasusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HukumanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\SKHPController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // 
    Route::get('/daftar-kasus', [DaftarKasusController::class, 'index'])->name('daftarKasus');
    Route::get('/daftar-kasus/tambah-kasus', [DaftarKasusController::class, 'create'])->name('daftarKasus.create');
    Route::post('/daftarKasus', [DaftarKasusController::class, 'store'])->name('daftarKasus.store');
    Route::get('/kasus/{id}/edit', [DaftarKasusController::class, 'edit'])->name('daftarKasus.edit');
    Route::put('/daftarKasus/{id}', [DaftarKasusController::class, 'update'])->name('daftarKasus.update');
    Route::post('/kasus/update-status/{id}', [DaftarKasusController::class, 'updateStatus']);
    Route::delete('/kasus/{id}', [DaftarKasusController::class, 'destroy'])->name('kasus.destroy');
    Route::get('/export-kasus', [DaftarKasusController::class, 'export'])->name('kasus.export');
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
    // pengaturan
    Route::get('/activity-logs', [PengaturanController::class, 'activityLogs'])->name('activityLogs.index');
    Route::get('/activity-logs/export', [PengaturanController::class, 'exportActivityLogs'])->name('activityLogs.export');
    // Hukuman
    Route::get('/hukuman', [HukumanController::class, 'index'])->name('hukuman');
    Route::post('/hukuman', [HukumanController::class, 'store'])->name('hukuman.store');
    Route::put('/hukuman/{id}', [HukumanController::class, 'update'])->name('hukuman.update');
    Route::delete('/hukuman/{id}', [HukumanController::class, 'destroy'])->name('hukuman.destroy');
    // Pelanggaran
    Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran');
    Route::post('/pelanggaran', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
    Route::put('/pelanggaran/{id}', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
    Route::delete('/pelanggaran/{id}', [PelanggaranController::class, 'destroy'])->name('pelanggaran.destroy');
    // Route untuk menampilkan daftar SKHP
    Route::get('/skhp', [SKHPController::class, 'index'])->name('skhp.index');
    Route::get('/skhp/create', [SKHPController::class, 'create'])->name('skhp.create');
    Route::post('/skhp', [SKHPController::class, 'store'])->name('skhp.store');
    Route::get('/skhp/{id}/edit', [SKHPController::class, 'edit'])->name('skhp.edit');
    Route::put('/skhp/{id}', [SKHPController::class, 'update'])->name('skhp.update');
    Route::delete('/skhp/{id}', [SKHPController::class, 'destroy'])->name('skhp.destroy');
    Route::get('/skhp/download/{id}', [SKHPController::class, 'downloadPDF'])->name('skhp.download');


});

require __DIR__.'/auth.php';
