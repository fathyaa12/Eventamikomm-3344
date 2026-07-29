<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'organizer') {
            // 1. Menjumlahkan nominal total_price milik Organizer yang login
            $totalRevenue = Transaction::whereIn('status', ['settlement', 'success'])
                ->whereHas('event', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->sum('total_price');

            // 2. Menghitung Berapa orang tamu yang tiketnya sudah Lunas milik Organizer
            $ticketsSold = Transaction::whereIn('status', ['settlement', 'success'])
                ->whereHas('event', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->count();

            // 3. Menghitung Jumlah Acara Mendatang yang aktif diselenggarakan milik Organizer
            $activeEvents = Event::where('user_id', $user->id)
                ->where('date', '>=', now())
                ->count();

            // 4. Menghitung Transaksi Ngadat milik Organizer
            $pendingOrders = Transaction::where('status', 'pending')
                ->whereHas('event', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->count();

            // 5. Menyertakan 5 daftar riwayat pesanan milik Organizer
            $recentTransactions = Transaction::with('event')
                ->whereHas('event', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->latest()
                ->take(5)
                ->get();
        } else {
            // Admin (Superadmin) - Global reports
            $totalRevenue = Transaction::whereIn('status', ['settlement', 'success'])->sum('total_price');
            $ticketsSold = Transaction::whereIn('status', ['settlement', 'success'])->count();
            $activeEvents = Event::where('date', '>=', now())->count();
            $pendingOrders = Transaction::where('status', 'pending')->count();
            $recentTransactions = Transaction::with('event')->latest()->take(5)->get();
        }

        return view('admin.dashboard', compact('totalRevenue', 'ticketsSold', 'activeEvents', 'pendingOrders', 'recentTransactions'));
    }
}
