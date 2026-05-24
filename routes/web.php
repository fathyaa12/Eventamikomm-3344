<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\Admin\CategoryController; // Disesuaikan namespace ke Admin
use App\Http\Controllers\Admin\PartnerController;  // Ditambahkan untuk Modul Partner
use App\Http\Controllers\WelcomeController;      // Ditambahkan untuk Halaman Utama Publik (Soal 4)
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Rute Publik / Sisi Pengunjung
|--------------------------------------------------------------------------
*/

// Menggunakan WelcomeController agar bisa merender data Partner & Kategori di homepage (Soal 4)
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/tentang', function () {
    return '<h1>Ini adalah Hlaman Tentang Aplikasi Event Hub</h1>';
});

Route::get('/kontak', function () {
    return view('contact');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});

Route::get('/ticket', function () {
    return view('layouts.ticket');
});

Route::get('/event-detail', function () {
    return view('layouts.event-detail');
});

Route::get('/chekout', function () {
    return view('layouts.chekout');
});


/*
|--------------------------------------------------------------------------
| Web Routes - Sisi Admin Panel (Grouped)
|--------------------------------------------------------------------------
*/

// Rute admin lama (opsional, bisa dihapus jika sudah menggunakan Resource Controller di bawah)
Route::get('/admin/dashboard', function () { return view('admin.dashboard'); });
Route::get('/admin/event', function () { return view('admin.event'); });
Route::get('/admin/transactions', function () { return view('admin.transactions'); });

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', EventAdminController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('partners', PartnerController::class);

});
