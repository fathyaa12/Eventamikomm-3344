<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Artisan;
use App\Models\Transaction;
use App\Http\Controllers\MidtransWebhookController;


Route::get('/jalankan-symlink', function () {
    Artisan::call('storage:link');
    return 'Symlink berhasil dibuat! Silakan cek kembali foto kamu.';
});

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'index'])->name('Welcome');
Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('events.show');



Route::get('/ticket/{order_id}', function ($order_id) {
    $transaction = Transaction::with('event')
        ->where('order_id', $order_id)
        ->firstOrFail();

    return view('ticket', compact('transaction'));
})->name('ticket');

Route::get('/category/{id}', [WelcomeController::class, 'category'])
    ->name('category.filter');

Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle'])
    ->name('midtrans.callback');
/*
|--------------------------------------------------------------------------
| Checkout Routes
|--------------------------------------------------------------------------
*/

Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])->name('checkout.payment');

Route::get('/success/{order_id}', [CheckoutController::class, 'success'])->name('checkout.success');
/*
|--------------------------------------------------------------------------
| Admin Routes (Modifikasi Pertemuan 8)
|--------------------------------------------------------------------------
*/

// Rute fallback global Laravel jika ada sistem yang melempar ke '/login'
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Grouping untuk URL berawalan /admin
Route::prefix('admin')->name('admin.')->group(function () {

    // Login & logout admin
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Route admin yang wajib login
    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', EventAdminController::class);
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');

        // Route yang hanya bisa diakses oleh Superadmin
        Route::middleware(['superadmin'])->group(function () {
            Route::resource('categories', CategoryController::class);
            Route::resource('partners', PartnerController::class);
            Route::get('organizers', [\App\Http\Controllers\Admin\OrganizerController::class, 'index'])->name('organizers.index');
            Route::patch('organizers/{organizer}/status', [\App\Http\Controllers\Admin\OrganizerController::class, 'updateStatus'])->name('organizers.update-status');
        });
    });
    Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransWebhookController::class, 'handle']);
});

// Route Registrasi Kepanitiaan/HIMA (Public)
Route::get('/register-organizer', [\App\Http\Controllers\Auth\OrganizerRegisterController::class, 'showRegister'])->name('organizer.register');
Route::post('/register-organizer', [\App\Http\Controllers\Auth\OrganizerRegisterController::class, 'register'])->name('organizer.register.post');

// Route SSO Google (Public)
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/logout/google', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')->with('success', 'Berhasil logout.');
})->name('logout.google');

// Route Ulasan (Rating & Review)
Route::post('/events/{event}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');
