@extends('layouts.app')

@section('content')
<main class="max-w-3xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold mb-6">Checkout Tiket</h1>

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>

        <p class="text-gray-600 mb-2">
            Lokasi: {{ $event->location }}
        </p>

        <p class="text-gray-600 mb-4">
            Tanggal: {{ $event->date }}
        </p>

        <p class="font-bold text-lg mb-6">
            @if($event->active_tier)
                Harga ({{ $event->active_tier->name }}): Rp {{ number_format($event->current_price, 0, ',', '.') }}
            @else
                Harga: Rp {{ number_format($event->current_price, 0, ',', '.') }}
            @endif
        </p>

        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-4 rounded-xl mb-6 font-bold text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        {{-- Google SSO Quick Login --}}
        @guest
            <div class="mb-6 p-5 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl text-center">
                <p class="text-slate-500 text-sm mb-3 font-medium">Login dulu untuk isi otomatis data kamu</p>
                <a href="{{ route('auth.google') }}"
                   class="inline-flex items-center justify-center gap-3 px-6 py-3 bg-white border-2 border-slate-200 rounded-2xl font-bold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition shadow-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Continue with Google
                </a>
            </div>
        @else
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-3">
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" alt="avatar" class="w-10 h-10 rounded-full">
                @else
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <p class="font-bold text-sm text-green-800">Login sebagai {{ auth()->user()->name }}</p>
                    <p class="text-xs text-green-600">{{ auth()->user()->email }}</p>
                </div>
            </div>
        @endguest

        <form action="{{ route('checkout.store', $event->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-medium">Nama Lengkap</label>
                <input
                    type="text"
                    name="customer_name"
                    value="{{ auth()->user()->name ?? old('customer_name') }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Email</label>
                <input
                    type="email"
                    name="customer_email"
                    value="{{ auth()->user()->email ?? old('customer_email') }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Nomor HP</label>
                <input
                    type="text"
                    name="customer_phone"
                    value="{{ old('customer_phone') }}"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Kode Kupon (Opsional)</label>
                <input
                    type="text"
                    name="voucher_code"
                    value="{{ old('voucher_code') }}"
                    class="w-full border rounded-lg px-4 py-2 uppercase"
                    placeholder="Masukkan kode kupon jika ada"
                >
            </div>

            <button
                type="submit"
                class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition"
            >
                Lanjutkan Pembayaran
            </button>
        </form>
    </div>
</main>
@endsection
