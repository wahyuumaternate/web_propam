<?php

use App\Http\Controllers\ArtisanRunnerController;
use App\Http\Controllers\DaftarKasusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HukumanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\SKHPController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TamplateSKHPController;
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

// Route::prefix('dashboard')->middleware('auth')->group(function () {
//     // artisan call
//     Route::get('/migrate', [ArtisanRunnerController::class, 'migrateFresh']);
//     Route::get('/link', [ArtisanRunnerController::class, 'link']);
//     Route::get('/cache', [ArtisanRunnerController::class, 'cache']);
    // // dashboard
    // Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // // 
    // Route::get('/daftar-kasus', [DaftarKasusController::class, 'index'])->name('daftarKasus');
    // Route::get('/daftar-kasus/tambah-kasus', [DaftarKasusController::class, 'create'])->name('daftarKasus.create');
    // Route::post('/daftarKasus', [DaftarKasusController::class, 'store'])->name('daftarKasus.store');
    // Route::get('/kasus/{id}/edit', [DaftarKasusController::class, 'edit'])->name('daftarKasus.edit');
    // Route::put('/daftarKasus/{id}', [DaftarKasusController::class, 'update'])->name('daftarKasus.update');
    // Route::post('/kasus/update-status/{id}', [DaftarKasusController::class, 'updateStatus']);
    // Route::delete('/kasus/{id}', [DaftarKasusController::class, 'destroy'])->name('kasus.destroy');
    // Route::get('/export-kasus', [DaftarKasusController::class, 'export'])->name('kasus.export');
//     // kategori
//     Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
//     Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
//     Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
//     Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
//     // pangkat
//     Route::get('/pangkat', [PangkatController::class, 'index'])->name('pangkat');
//     Route::post('/pangkat', [PangkatController::class, 'store'])->name('pangkat.store');
//     Route::put('/pangkat/{id}', [PangkatController::class, 'update'])->name('pangkat.update');
//     Route::delete('/pangkat/{id}', [PangkatController::class, 'destroy'])->name('pangkat.destroy');
//     // satker
//     Route::get('/satker-satwil', [SatkerController::class, 'index'])->name('satker');
//     Route::post('/satker', [SatkerController::class, 'store'])->name('satker.store');
//     Route::put('/satker/{id}', [SatkerController::class, 'update'])->name('satker.update');
//     Route::delete('/satker/{id}', [SatkerController::class, 'destroy'])->name('satker.destroy');
//     // status
//     Route::get('/status', [StatusController::class, 'index'])->name('status');
//     Route::post('/status', [StatusController::class, 'store'])->name('status.store');
//     Route::put('/status/{id}', [StatusController::class, 'update'])->name('status.update');
//     Route::delete('/status/{id}', [StatusController::class, 'destroy'])->name('status.destroy');
//     // pengaturan
//     Route::get('/activity-logs', [PengaturanController::class, 'activityLogs'])->name('activityLogs.index');
//     Route::get('/activity-logs/export', [PengaturanController::class, 'exportActivityLogs'])->name('activityLogs.export');
//     // Hukuman
//     Route::get('/hukuman', [HukumanController::class, 'index'])->name('hukuman');
//     Route::post('/hukuman', [HukumanController::class, 'store'])->name('hukuman.store');
//     Route::put('/hukuman/{id}', [HukumanController::class, 'update'])->name('hukuman.update');
//     Route::delete('/hukuman/{id}', [HukumanController::class, 'destroy'])->name('hukuman.destroy');
//     // Pelanggaran
//     Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran');
//     Route::post('/pelanggaran', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
//     Route::put('/pelanggaran/{id}', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
//     Route::delete('/pelanggaran/{id}', [PelanggaranController::class, 'destroy'])->name('pelanggaran.destroy');
//     // Route untuk menampilkan daftar SKHP
//     Route::get('/skhp', [SKHPController::class, 'index'])->name('skhp.index');
//     Route::get('/skhp/create', [SKHPController::class, 'create'])->name('skhp.create');
//     Route::post('/skhp', [SKHPController::class, 'store'])->name('skhp.store');
//     Route::get('/skhp/{id}/edit', [SKHPController::class, 'edit'])->name('skhp.edit');
//     Route::put('/skhp/{id}', [SKHPController::class, 'update'])->name('skhp.update');
//     Route::delete('/skhp/{id}', [SKHPController::class, 'destroy'])->name('skhp.destroy');
//     Route::get('/skhp/download/{id}', [SKHPController::class, 'downloadPDF'])->name('skhp.download');
//     Route::get('/skhp-tamplate', [TamplateSKHPController::class, 'index'])->name('skhp.tamplate');
//     Route::put('/skhp/tamplate/{id}/update', [TamplateSkhpController::class, 'update'])->name('skhp.tamplate.update');
//     // ROle
//     Route::get('/role', [RoleController::class, 'index'])->name('roles.index'); // Untuk menampilkan daftar role
//     Route::get('/role-create', [RoleController::class, 'create'])->name('roles.create'); // Untuk form tambah role
//     Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->name('roles.edit'); // Untuk form edit role
//     Route::post('/role', [RoleController::class, 'store'])->name('roles.store'); // Untuk menyimpan role baru
//     Route::put('/role/{id}', [RoleController::class, 'update'])->name('roles.update'); // Untuk mengupdate role
//     Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('roles.destroy'); // Untuk menghapus role

// });

Route::prefix('dashboard')->middleware('auth')->group(function () {

    // artisan call
    Route::get('/migrate', [ArtisanRunnerController::class, 'migrateFresh']);
    Route::get('/link', [ArtisanRunnerController::class, 'link']);
    Route::get('/cache', [ArtisanRunnerController::class, 'cache']);

    // Dashboard - Protected by a permission check
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');  // Replace 'lihat_dashboard' with your specific permission

    // kasus
    Route::get('/daftar-kasus', [DaftarKasusController::class, 'index'])
    ->name('daftarKasus')->middleware('check_permission:lihat_kasus,lihat_semua_kasus');
    Route::get('/daftar-kasus/tambah-kasus', [DaftarKasusController::class, 'create'])->name('daftarKasus.create')
        ->middleware('check_permission:tambah_kasus');
    Route::post('/daftarKasus', [DaftarKasusController::class, 'store'])->name('daftarKasus.store')
        ->middleware('check_permission:tambah_kasus');
    Route::get('/kasus/{id}/edit', [DaftarKasusController::class, 'edit'])->name('daftarKasus.edit')
        ->middleware('check_permission:edit_kasus');
    Route::put('/daftarKasus/{id}', [DaftarKasusController::class, 'update'])->name('daftarKasus.update')
        ->middleware('check_permission:edit_kasus');
    Route::post('/kasus/update-status/{id}', [DaftarKasusController::class, 'updateStatus'])
        ->middleware('check_permission:update_status_kasus');
    Route::delete('/kasus/{id}', [DaftarKasusController::class, 'destroy'])->name('kasus.destroy')
        ->middleware('check_permission:hapus_kasus');
    Route::get('/export-kasus', [DaftarKasusController::class, 'export'])->name('kasus.export')
        ->middleware('check_permission:export_kasus');

        // Kategori Routes - Protected by permission middleware
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori')
    ->middleware('check_permission:lihat_kategori');  // Replace with your specific permission for viewing categories
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store')
        ->middleware('check_permission:tambah_kategori'); // Replace with permission for adding categories
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update')
        ->middleware('check_permission:edit_kategori');  // Replace with permission for editing categories
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy')
        ->middleware('check_permission:hapus_kategori'); // Replace with permission for deleting categories

    // Pangkat Routes - Protected by permission middleware
    Route::get('/pangkat', [PangkatController::class, 'index'])->name('pangkat')
        ->middleware('check_permission:lihat_pangkat'); // Replace with your specific permission for viewing ranks
    Route::post('/pangkat', [PangkatController::class, 'store'])->name('pangkat.store')
        ->middleware('check_permission:tambah_pangkat'); // Replace with permission for adding ranks
    Route::put('/pangkat/{id}', [PangkatController::class, 'update'])->name('pangkat.update')
        ->middleware('check_permission:edit_pangkat');  // Replace with permission for editing ranks
    Route::delete('/pangkat/{id}', [PangkatController::class, 'destroy'])->name('pangkat.destroy')
        ->middleware('check_permission:hapus_pangkat'); // Replace with permission for deleting ranks

         // Satker Routes - Protected by permission middleware
    Route::get('/satker-satwil', [SatkerController::class, 'index'])->name('satker')
    ->middleware('check_permission:lihat_satker');  // Replace with the permission for viewing Satker
    Route::post('/satker', [SatkerController::class, 'store'])->name('satker.store')
        ->middleware('check_permission:tambah_satker');  // Replace with the permission for adding Satker
    Route::put('/satker/{id}', [SatkerController::class, 'update'])->name('satker.update')
        ->middleware('check_permission:edit_satker');  // Replace with the permission for editing Satker
    Route::delete('/satker/{id}', [SatkerController::class, 'destroy'])->name('satker.destroy')
        ->middleware('check_permission:hapus_satker');  // Replace with the permission for deleting Satker

    // Status Routes - Protected by permission middleware
    Route::get('/status', [StatusController::class, 'index'])->name('status')
        ->middleware('check_permission:lihat_status');  // Replace with the permission for viewing Status
    Route::post('/status', [StatusController::class, 'store'])->name('status.store')
        ->middleware('check_permission:tambah_status');  // Replace with the permission for adding Status
    Route::put('/status/{id}', [StatusController::class, 'update'])->name('status.update')
        ->middleware('check_permission:edit_status');  // Replace with the permission for editing Status
    Route::delete('/status/{id}', [StatusController::class, 'destroy'])->name('status.destroy')
    ->middleware('check_permission:hapus_status');  // Replace with the permission for deleting Status

    // Pengaturan Routes - Protected by permission middleware
    Route::get('/pengaturan/activity-logs', [PengaturanController::class, 'activityLogs'])->name('activityLogs.index')
        ->middleware('check_permission:lihat_activity_logs');  // Replace with your specific permission for viewing activity logs

    Route::get('/pengaturan/activity-logs/export', [PengaturanController::class, 'exportActivityLogs'])->name('activityLogs.export')
        ->middleware('check_permission:export_activity_logs');  // Replace with permission for exporting activity logs

    // Hukuman Routes - Protected by permission middleware
    Route::get('/hukuman', [HukumanController::class, 'index'])->name('hukuman')
        ->middleware('check_permission:lihat_hukuman');  // Replace with the permission for viewing hukuman
    Route::post('/hukuman', [HukumanController::class, 'store'])->name('hukuman.store')
        ->middleware('check_permission:tambah_hukuman');  // Replace with permission for adding hukuman
    Route::put('/hukuman/{id}', [HukumanController::class, 'update'])->name('hukuman.update')
        ->middleware('check_permission:edit_hukuman');  // Replace with permission for editing hukuman
    Route::delete('/hukuman/{id}', [HukumanController::class, 'destroy'])->name('hukuman.destroy')
        ->middleware('check_permission:hapus_hukuman');  // Replace with permission for deleting hukuman

    // Pelanggaran Routes - Protected by permission middleware
    Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran')
        ->middleware('check_permission:lihat_pelanggaran');  // Replace with the permission for viewing pelanggaran
    Route::post('/pelanggaran', [PelanggaranController::class, 'store'])->name('pelanggaran.store')
        ->middleware('check_permission:tambah_pelanggaran');  // Replace with permission for adding pelanggaran
    Route::put('/pelanggaran/{id}', [PelanggaranController::class, 'update'])->name('pelanggaran.update')
        ->middleware('check_permission:edit_pelanggaran');  // Replace with permission for editing pelanggaran
    Route::delete('/pelanggaran/{id}', [PelanggaranController::class, 'destroy'])->name('pelanggaran.destroy')
        ->middleware('check_permission:hapus_pelanggaran');  // Replace with permission for deleting pelanggaran
    
    // SKHP Routes - Protected by permission middleware
    Route::get('/skhp', [SKHPController::class, 'index'])->name('skhp.index')
        ->middleware('check_permission:lihat_skhp,lihat_semua_skhp');  // Replace with permission for viewing SKHP
    Route::get('/skhp/create', [SKHPController::class, 'create'])->name('skhp.create')
        ->middleware('check_permission:tambah_skhp');  // Replace with permission for creating SKHP
    Route::post('/skhp', [SKHPController::class, 'store'])->name('skhp.store')
        ->middleware('check_permission:tambah_skhp');  // Replace with permission for storing SKHP
    Route::get('/skhp/{id}/edit', [SKHPController::class, 'edit'])->name('skhp.edit')
        ->middleware('check_permission:edit_skhp');  // Replace with permission for editing SKHP
    Route::put('/skhp/{id}', [SKHPController::class, 'update'])->name('skhp.update')
        ->middleware('check_permission:edit_skhp');  // Replace with permission for updating SKHP
    Route::delete('/skhp/{id}', [SKHPController::class, 'destroy'])->name('skhp.destroy')
        ->middleware('check_permission:hapus_skhp');  // Replace with permission for deleting SKHP
    Route::get('/skhp/download/{id}', [SKHPController::class, 'downloadPDF'])->name('skhp.download')
        ->middleware('check_permission:download_skhp');  // Replace with permission for downloading SKHP
    Route::get('/skhp-tamplate', [TamplateSKHPController::class, 'index'])->name('skhp.tamplate')
        ->middleware('check_permission:lihat_skhp_tamplate');  // Replace with permission for viewing SKHP template
    Route::put('/skhp/tamplate/{id}/update', [TamplateSKHPController::class, 'update'])->name('skhp.tamplate.update')
        ->middleware('check_permission:edit_skhp_tamplate');  // Replace with permission for updating SKHP template

    // Role Management Routes - Protected by permission middleware
    Route::get('/pengaturan/role', [RoleController::class, 'index'])->name('roles.index')
        ->middleware('check_permission:lihat_role');  // Replace with permission for viewing roles
    Route::get('/pengaturan/role-create', [RoleController::class, 'create'])->name('roles.create')
        ->middleware('check_permission:tambah_role');  // Replace with permission for creating roles
    Route::get('/pengaturan/role-edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')
        ->middleware('check_permission:edit_role');  // Replace with permission for editing roles
    Route::post('/pengaturan/role', [RoleController::class, 'store'])->name('roles.store')
        ->middleware('check_permission:tambah_role');  // Replace with permission for storing roles
    Route::put('/pengaturan/role/{id}', [RoleController::class, 'update'])->name('roles.update')
        ->middleware('check_permission:edit_role');  // Replace with permission for updating roles
    Route::delete('/pengaturan/role/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')
        ->middleware('check_permission:hapus_role');  // Replace with permission for deleting roles
        Route::resource('/pengaturan/users', PenggunaController::class);
});


require __DIR__.'/auth.php';
