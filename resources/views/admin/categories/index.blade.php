@extends('layouts.admin', ['title' => 'Kelola Kategori'])


@section('content')
    <h1 class="text-2xl font-bold mb-6">Manajemen Kategori AmikomEventHub</h1>

    <div class="bg-white p-4 rounded-lg shadow-md mb-6 flex justify-between items-center">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-2 w-full max-w-md">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama kategori..."
                class="w-full px-3 py-2 border rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit"
                class="bg-gray-700 text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-gray-800 transition">Cari</button>
            @if ($search)
                <a href="{{ route('admin.categories.index') }}"
                    class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm flex items-center hover:bg-red-600 transition">Reset</a>
            @endif
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md h-fit">
            <h2 class="text-lg font-semibold mb-4">Tambah Kategori Baru</h2>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <input type="text" name="name"
                    class="w-full px-3 py-2 border rounded-lg mb-4 outline-none focus:ring-2 focus:ring-blue-500" required>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg cursor-pointer hover:bg-blue-700 transition">Simpan</button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md md:col-span-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-xs uppercase text-gray-700">
                        <th class="p-3">ID</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3 text-sm text-gray-600">{{ $cat->id }}</td>
                            <td class="p-3 font-semibold text-gray-800">{{ $cat->name }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('admin.categories.edit', $cat->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded text-xs font-medium hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-xs font-medium cursor-pointer hover:bg-red-600 transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center p-4 text-gray-400 text-sm">Data kategori tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
