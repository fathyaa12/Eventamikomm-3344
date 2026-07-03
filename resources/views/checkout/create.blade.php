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
            Harga: Rp {{ number_format($event->price, 0, ',', '.') }}
        </p>

        <form action="{{ route('checkout.store', $event->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-medium">Nama Lengkap</label>
                <input
                    type="text"
                    name="customer_name"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Email</label>
                <input
                    type="email"
                    name="customer_email"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Nomor HP</label>
                <input
                    type="text"
                    name="customer_phone"
                    class="w-full border rounded-lg px-4 py-2"
                    required
                >
            </div>

            <button
                type="submit"
                class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold"
            >
                Lanjutkan Pembayaran
            </button>
        </form>
    </div>
</main>
@endsection
