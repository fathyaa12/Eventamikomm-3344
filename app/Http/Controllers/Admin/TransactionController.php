<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'organizer') {
            $transactions = Transaction::with('event')
                ->whereHas('event', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->latest()
                ->paginate(20);
        } else {
            // Admin (Superadmin)
            $transactions = Transaction::with('event')->latest()->paginate(20);
        }
        return view('admin.transactions.index', compact('transactions'));
    }
}
