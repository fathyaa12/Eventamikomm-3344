<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();

        // Cek apakah user pernah beli tiket event ini
        $hasPurchased = Transaction::where('event_id', $event->id)
            ->where('customer_email', $user->email)
            ->where('status', 'success')
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'Anda harus membeli tiket acara ini terlebih dahulu untuk memberikan ulasan.');
        }

        // Cek apakah event sudah selesai minimal 1 hari yang lalu
        if ($event->date > now()->subDay()) {
            return back()->with('error', 'Ulasan hanya bisa diberikan minimal sehari setelah acara selesai.');
        }

        // Cek apakah sudah pernah review
        if ($event->reviews()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk acara ini.');
        }

        $event->reviews()->create([
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Ulasan Anda berhasil disimpan. Terima kasih!');
    }
}
