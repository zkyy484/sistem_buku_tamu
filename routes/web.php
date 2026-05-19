<?php

use App\Http\Controllers\Admin\AdminKonsultasiController;
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

// route tamu
// route untuk halaman form pengisian konsultasi pada tamu
Route::get('/buku-tamu', [TamuController::class, 'index']);

// route untuk halaman opening pada tamu
Route::get('/', [TamuController::class, 'opening']);

// route untuk mengirim form data konsultasi pada tamu
Route::post('/konsultasi/store', [TamuController::class, 'store']);

// route khusus role admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        // route halaman dashboard admin
        Route::get('/dashboard', [AdminDashboard::class, 'index']);

        // route halaman laporan konsultasi pada admin
        Route::get('/laporan', [AdminLaporan::class, 'index']);

        // route untuk ekport/unduh pdf laporan konsultasi pada admin
        Route::get('/laporan/pdf', [AdminLaporan::class, 'exportPdf']);

        // route halaman daftar laporan pengunjung pada admin
        Route::get('/laporan/pengunjung', [AdminLaporan::class, 'index_1']);

        // route  untuk ekxport/unduh pdf laporan pengunjung pada admin
        Route::get('/laporan/pengunjung/pdf', [AdminLaporan::class, 'exportPdf_1']);

        // rouute untuk crud sub bagian pada admin
        Route::resource('sub-bagian', SubBagianController::class);

        // route untuk crud tujuan konsultasi pada admin
        Route::resource('tujuan-konsultasi', TujuanKonsultasiController::class);

        // route untuk crud akun pegawai pada admin
        Route::resource('pegawai', DataPegawaiController::class);

        // route untuk halaman daftar konsultasi pada admin
        Route::get('/konsultasi', [AdminKonsultasiController::class, 'index'])->name('index.admin.konsultasi');

        // route untuk menampilkan halaman detail konsultasi pada admin
        Route::get('/konsultasi/{id}', [AdminKonsultasiController::class, 'show']);

        // route untuk melakukan update data konsultasi oada admin
        Route::put('/konsultasi/{id}', [AdminKonsultasiController::class, 'update']);

        // route untuk mengubah status akun pegawai pada admin
        Route::put(
            '/pegawai-status/{id}',
            [DataPegawaiController::class, 'changeStatus']
        );
        
        // route untuk mengubah status data sub bagian pada admin
        Route::put(
            '/sub-bagian-status/{id}',
            [
                SubBagianController::class,
                'changeStatus'
            ]
        );

        // route untuk mengubah status data tujuan konsultasi pada admin
        Route::put(
            '/tujuan-status/{id}',
            [
                TujuanKonsultasiController::class,
                'changeStatus'
            ]
        );

        // route untuk download pdf data konsultasi pada admin
        Route::get(
            '/konsultasi/{id}/download-pdf',
            [AdminKonsultasiController::class, 'downloadPdf']
        );

    });


// route khusus role pegawai
Route::middleware(['auth', 'role:pegawai'])
    ->prefix('pegawai')
    ->group(function () {

        // route untuk halaman dashboard pada pegawai
        Route::get('/dashboard', [PegawaiDashboard::class, 'index']);

        // route halaman daftar data konsultasi pada pegawai
        Route::get('/konsultasi', [KonsultasiController::class, 'index']);

        // route untuk halaman detail konsultasi pada pegawai
        Route::get('/konsultasi/{id}', [KonsultasiController::class, 'show']);

        // route untuk update data konsultasi pada pegawai
        Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update']);

        // route untuk download/unduh pdf data konsultasi oada pegawai
        Route::get(
            '/konsultasi/{id}/download-pdf',
            [KonsultasiController::class, 'downloadPdf']
        );
    });


// route khusus role pimpinan
Route::middleware(['auth', 'role:pimpinan'])
    ->prefix('pimpinan')
    ->group(function () {

        // route untuk halaman dashboard pada admin
        Route::get('/dashboard', [PimpinanDashboard::class, 'index']);

        // route untuk halaman laporan data konsultasi pada pimpinan
        Route::get('/laporan', [PimpinanLaporan::class, 'index']);
    });





// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


require __DIR__ . '/auth.php';
