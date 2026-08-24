<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\JenisPegawaiController;
use App\Http\Controllers\PendidikanController;

Route::redirect('/', '/login');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/dosen/trash', [DosenController::class, 'trash'])->name('dosen.trash');

    Route::patch('/dosen/{id}/restore', [DosenController::class, 'restore'])->name('dosen.restore');

    Route::delete('/dosen/{id}/force-delete', [DosenController::class, 'forceDelete'])
        ->name('dosen.forceDelete');

    Route::get(
        '/program-studis/by-unit-kerja/{unitKerja}',
        [ProgramStudiController::class, 'byUnitKerja']
    )->name('program-studis.by-unit-kerja');

    //menampilkan tendik yg disoft delete
    Route::get('/tendik/trash', [TendikController::class, 'trash'])->name('tendik.trash');

    //memulihkan data tendik yang ada di trash
    Route::patch('/tendik/{id}/restore', [TendikController::class, 'restore'])
        ->name('tendik.restore');

    //menghapus permanen data tendik
    Route::delete('/tendik/{id}/force-delete', [TendikController::class, 'forceDelete'])
        ->name('tendik.forceDelete');

    Route::resource('dosen', DosenController::class);

    Route::resource('tendik', TendikController::class);

    Route::resource('unit-kerja', UnitKerjaController::class);

    Route::resource('program-studi', ProgramStudiController::class);

    // Menyediakan seluruh route CRUD untuk Master Agama.
    Route::resource('agama', AgamaController::class);

    Route::resource('pendidikan', PendidikanController::class);

    Route::resource('jenis-pegawai', JenisPegawaiController::class);
});

require __DIR__ . '/auth.php';
