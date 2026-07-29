<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index()
    {
        // Hanya user dengan role organizer yang dikelola statusnya
        $organizers = User::where('role', 'organizer')->latest()->paginate(20);
        return view('admin.organizers.index', compact('organizers'));
    }

    public function updateStatus(Request $request, User $organizer)
    {
        $request->validate([
            'status' => 'required|in:pending,active,suspended',
        ]);

        $organizer->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status penyelenggara "' . $organizer->name . '" berhasil diubah menjadi ' . $request->status . '.');
    }
}
