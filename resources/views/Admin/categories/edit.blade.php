@extends('layouts.admin')

@section('title', 'Admin - Edit Kategori')

@section('content')

    <div class="max-w-xl mx-auto">
        <a href="{{ route('admin.categories.index') }}" class="text-blue-600 text-sm mb-4 inline-block hover:underline">&larr; Kembali ke Daftar</a>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Nama Kategori</h2>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg cursor-pointer hover:bg-blue-700 transition">Simpan Perubahan</button>
            </form>
        </div>
    </div>

@endsection
