<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Http\Request;

Route::resource('mahasiswa', MahasiswaController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cari', [MahasiswaController::class, 'cari'])->name('cari');

Route::get('mahasiswa/nilai/{id_mahasiswa}', [MahasiswaController::class, 'nilai'])->name('nilai');

Route::get('mahasiswa/nilai/{id_mahasiswa}/cetak_nilai', [MahasiswaController::class, 'cetak_nilai'])->name('mahasiswa.cetak_nilai');