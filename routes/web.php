<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/event', function () {
    return view('admin.event');
});


Route::get('/admin/transactions', function () {
    return view('admin.transactions');
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
