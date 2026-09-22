<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Models\Anggota;
use App\Models\Inventaris;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'anggotaCount' => Anggota::count(),
        'inventarisCount' => Inventaris::count(),
        'kegiatanCount' => Kegiatan::count(),
        'userCount' => User::count(),
    ]);
})->name('home');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('role:pengurus,anggota');

    Route::middleware('role:pengurus,anggota')->group(function () {
        Route::get('/laporan', [ReportController::class, 'index'])->name('report.index');
        Route::get('/laporan/anggota', [ReportController::class, 'anggota'])->name('report.anggota');
        Route::get('/laporan/inventaris', [ReportController::class, 'inventaris'])->name('report.inventaris');
        Route::get('/laporan/kegiatan', [ReportController::class, 'kegiatan'])->name('report.kegiatan');
        Route::get('/laporan/anggota/pdf', [ReportController::class, 'exportPdfAnggota'])->name('report.anggota.pdf');
        Route::get('/laporan/inventaris/pdf', [ReportController::class, 'exportPdfInventaris'])->name('report.inventaris.pdf');
        Route::get('/laporan/kegiatan/pdf', [ReportController::class, 'exportPdfKegiatan'])->name('report.kegiatan.pdf');
        Route::get('/laporan/anggota/print', [ReportController::class, 'printAnggota'])->name('report.anggota.print');
        Route::get('/laporan/inventaris/print', [ReportController::class, 'printInventaris'])->name('report.inventaris.print');
        Route::get('/laporan/kegiatan/print', [ReportController::class, 'printKegiatan'])->name('report.kegiatan.print');
    });

    Route::middleware('role:pengurus')->group(function () {
        Route::resource('anggota', AnggotaController::class)->parameters(['anggotum' => 'anggota']);
        Route::get('/anggota/export/excel', [AnggotaController::class, 'exportExcel'])->name('anggota.export.excel');
        Route::get('/anggota/export/pdf', [AnggotaController::class, 'exportPdf'])->name('anggota.export.pdf');
        Route::resource('inventaris', InventarisController::class)->parameters(['inventaris' => 'inventaris']);
        Route::get('/inventaris/export/excel', [InventarisController::class, 'exportExcel'])->name('inventaris.export.excel');
        Route::get('/inventaris/export/pdf', [InventarisController::class, 'exportPdf'])->name('inventaris.export.pdf');
        Route::resource('kegiatan', KegiatanController::class);
        Route::resource('laporan-manage', LaporanController::class)->parameters(['laporan-manage' => 'laporan'])->names('laporan');
        Route::resource('users', UserController::class);
    });

    Route::middleware('role:anggota,pengurus')->group(function () {
        Route::get('/profil', function () {
            return view('profil');
        })->name('profil');
        Route::get('/gallery', function () {
            return view('gallery');
        })->name('gallery');
        Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('/kegiatan/{kegiatan}', [KegiatanController::class, 'show'])->name('kegiatan.show');
        Route::resource('galeri', GaleriController::class)->except(['show']);
        Route::get('/galeri/{galeri}', [GaleriController::class, 'show'])->name('galeri.show');
    });

    Route::get('/laporan-manage/{laporan}/preview', [LaporanController::class, 'preview'])->name('laporan.preview')->middleware('role:pengurus,anggota');
    Route::get('/laporan-manage/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel')->middleware('role:pengurus');
    Route::get('/laporan-manage/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf')->middleware('role:pengurus');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
