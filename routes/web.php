<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Artisan;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/kegiatan', [PublicController::class, 'kegiatan'])->name('kegiatan');
Route::get('/kegiatan/{id}', [PublicController::class, 'kegiatanDetail'])->name('kegiatan.detail');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::get('/harga-sampah', [PublicController::class, 'hargaSampah'])->name('harga-sampah');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Nasabah Routes
Route::middleware(['auth'])->prefix('nasabah')->name('nasabah.')->group(function () {
    Route::get('/dashboard', [NasabahController::class, 'dashboard'])->name('dashboard');
    Route::get('/setoran', [NasabahController::class, 'setoranForm'])->name('setoran.form');
    Route::post('/setoran', [NasabahController::class, 'storeSetoran'])->name('setoran.store');
    Route::get('/riwayat', [NasabahController::class, 'riwayat'])->name('riwayat');
    Route::get('/penarikan', [NasabahController::class, 'penarikanForm'])->name('penarikan.form');
    Route::post('/penarikan', [NasabahController::class, 'storePenarikan'])->name('penarikan.store');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/nasabah', [AdminController::class, 'nasabah'])->name('nasabah');
    Route::get('/setoran', [AdminController::class, 'setoran'])->name('setoran');
    Route::get('/penarikan', [AdminController::class, 'penarikan'])->name('penarikan');
    Route::get('/harga-sampah', [AdminController::class, 'hargaSampah'])->name('harga-sampah');
    Route::get('/harga-sampah/create', [AdminController::class, 'createHargaSampah'])->name('harga-sampah.create');
    Route::post('/harga-sampah', [AdminController::class, 'storeHargaSampah'])->name('harga-sampah.store');
    Route::get('/harga-sampah/{id}/edit', [AdminController::class, 'editHargaSampah'])->name('harga-sampah.edit');
    Route::put('/harga-sampah/{id}', [AdminController::class, 'updateHargaSampah'])->name('harga-sampah.update');
    Route::delete('/harga-sampah/{id}', [AdminController::class, 'destroyHargaSampah'])->name('harga-sampah.destroy');
    Route::get('/keuangan', [AdminController::class, 'keuangan'])->name('keuangan');
    Route::get('/keuangan/create', [AdminController::class, 'createKeuangan'])->name('keuangan.create');
    Route::post('/keuangan', [AdminController::class, 'storeKeuangan'])->name('keuangan.store');
    Route::get('/keuangan/{id}/edit', [AdminController::class, 'editKeuangan'])->name('keuangan.edit');
    Route::put('/keuangan/{id}', [AdminController::class, 'updateKeuangan'])->name('keuangan.update');
    Route::delete('/keuangan/{id}', [AdminController::class, 'destroyKeuangan'])->name('keuangan.destroy');
    Route::get('/laporan-keuangan', [AdminController::class, 'laporanKeuangan'])->name('laporan.keuangan');
    
    // Kegiatan Routes
    Route::get('/kegiatan', [AdminController::class, 'kegiatan'])->name('kegiatan');
    Route::get('/kegiatan/create', [AdminController::class, 'createKegiatan'])->name('kegiatan.create');
    Route::post('/kegiatan', [AdminController::class, 'storeKegiatan'])->name('kegiatan.store');
    Route::get('/kegiatan/{id}/edit', [AdminController::class, 'editKegiatan'])->name('kegiatan.edit');
    Route::put('/kegiatan/{id}', [AdminController::class, 'updateKegiatan'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [AdminController::class, 'destroyKegiatan'])->name('kegiatan.destroy');
    
    // Galeri Routes
    Route::get('/galeri', [AdminController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/create', [AdminController::class, 'createGaleri'])->name('galeri.create');
    Route::post('/galeri', [AdminController::class, 'storeGaleri'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [AdminController::class, 'editGaleri'])->name('galeri.edit');
    Route::put('/galeri/{id}', [AdminController::class, 'updateGaleri'])->name('galeri.update');
    Route::delete('/galeri/{id}', [AdminController::class, 'destroyGaleri'])->name('galeri.destroy');
    
// Laporan Routes
Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
Route::post('/laporan/generate', [AdminController::class, 'generateLaporan'])->name('laporan.generate');

Route::get('/run-migrate', function(){
    try {
        Artisan::call('migrate:fresh --force');
        Artisan::call('db:seed --force');
        return 'Migration and seeding success! Website siap digunakan.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
});