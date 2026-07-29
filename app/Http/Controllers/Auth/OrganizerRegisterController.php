<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrganizerRegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register-organizer');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'organizer',
            'status' => 'pending', // Default pending, waiting for superadmin approval
        ]);

        return redirect()->route('admin.login')->with('success', 'Pendaftaran berhasil! Akun Anda sedang dalam proses peninjauan oleh Admin. Silakan tunggu persetujuan.');
    }
}
