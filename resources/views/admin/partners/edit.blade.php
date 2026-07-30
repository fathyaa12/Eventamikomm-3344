@extends('layouts.admin')

@section('title', 'Admin - Edit Partner')

@section('content')

    <div class="max-w-xl mx-auto">
        <a href="{{ route('admin.partners.index') }}" class="text-blue-600 text-sm mb-4 inline-block hover:underline">&larr; Kembali ke Daftar</a>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Data Partner</h2>

            <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Partner</label>
                    <input type="text" name="name" value="{{ $partner->name }}" class="w-full px-3 py-2 border rounded-lg mb-2 outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Logo Saat Ini</label>
                    <img src="{{ $partner->logo_asset_url }}" class="h-20 w-32 object-contain bg-gray-50 border p-1 rounded mb-3">

                    <label class="block text-gray-700 text-xs font-bold mb-2">Ganti Logo Berkas</label>
                    <input type="file" name="logo" class="w-full text-sm mt-1 block mb-3">
                    
                    <label class="block text-gray-700 text-xs font-bold mb-2">Atau Ganti URL Logo (Dari Internet)</label>
                    <input type="url" name="logo_link" placeholder="https://..." class="w-full px-3 py-2 border rounded-lg outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <p class="text-xs text-gray-500 mt-1">*Kosongkan keduanya jika tidak ingin mengubah logo.</p>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg cursor-pointer hover:bg-blue-700 transition">Simpan Perubahan</button>
            </form>
        </div>
    </div>

@endsection
