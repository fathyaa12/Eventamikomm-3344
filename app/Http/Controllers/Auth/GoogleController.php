<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    // Mengarahkan pengguna ke halaman OAuth Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }

    // Mengolah balasan (callback) setelah pengguna mengizinkan di Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah pernah daftar lewat email atau Google
            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            if ($user) {
                // Update data Google ID & foto jika sudah ada
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar'    => $googleUser->avatar,
                ]);
            } else {
                // Buat user baru jika belum terdaftar
                $user = User::create([
                    'name'      => $googleUser->name,
                    'email'     => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar'    => $googleUser->avatar,
                    'password'  => null,
                ]);
            }

            Auth::login($user);

            return redirect()->intended('/')->with('success', 'Berhasil login menggunakan akun Google!');
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Gagal login Google: ' . $e->getMessage());
        }
    }
}
