<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboard;
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboard;
use App\Http\Controllers\Admin\SubBagianController;
use App\Http\Controllers\Admin\TujuanKonsultasiController;
use App\Http\Controllers\Admin\DataPegawaiController;
use App\Http\Controllers\Guest\TamuController;
use App\Http\Controllers\Pegawai\KonsultasiController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporan;
use App\Http\Controllers\Pimpinan\LaporanController as PimpinanLaporan;


Route::get('/buku-tamu', [TamuController::class, 'index']);
Route::get('/', [TamuController::class, 'opening']);
Route::post('/konsultasi/store', [TamuController::class, 'store']);


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index']);
        Route::get('/laporan', [AdminLaporan::class, 'index']);
        Route::get('/laporan/pdf', [AdminLaporan::class, 'exportPdf']);

        Route::resource('sub-bagian', SubBagianController::class);
        Route::resource('tujuan-konsultasi', TujuanKonsultasiController::class);
        Route::resource('pegawai', DataPegawaiController::class);

        Route::put(
            '/pegawai-status/{id}',
            [DataPegawaiController::class, 'changeStatus']
        );

        Route::put(
            '/sub-bagian-status/{id}',
            [
                SubBagianController::class,
                'changeStatus'
            ]
        );

        Route::put(
            '/tujuan-status/{id}',
            [
                TujuanKonsultasiController::class,
                'changeStatus'
            ]
        );

    });

Route::middleware(['auth', 'role:pegawai'])
    ->prefix('pegawai')
    ->group(function () {

        Route::get('/dashboard', [PegawaiDashboard::class, 'index']);

        Route::get('/konsultasi', [KonsultasiController::class, 'index']);

        Route::get('/konsultasi/{id}', [KonsultasiController::class, 'show']);

        Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update']);

        Route::get(
            '/konsultasi/{id}/download-pdf',
            [KonsultasiController::class, 'downloadPdf']
        );
    });

Route::middleware(['auth', 'role:pimpinan'])
    ->prefix('pimpinan')
    ->group(function () {

        Route::get('/dashboard', [PimpinanDashboard::class, 'index']);
        Route::get('/laporan', [PimpinanLaporan::class, 'index']);
    });




// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
