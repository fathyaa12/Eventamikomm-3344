@extends('layouts.admin')

@section('title', 'Admin - Manajemen Partner')

@section('content')

    <h1 class="text-2xl font-bold mb-6">Manajemen Partner AmikomEventHub</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
        <form action="{{ route('admin.partners.index') }}" method="GET" class="flex gap-2 max-w-md">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama partner..."
                class="w-full px-3 py-2 border rounded-lg outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit"
                class="bg-gray-700 text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-gray-800 transition">Cari</button>
            @if ($search)
                <a href="{{ route('admin.partners.index') }}"
                    class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm flex items-center hover:bg-red-600 transition">Reset</a>
            @endif
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md h-fit">
            <h2 class="font-semibold mb-4">Tambah Partner Baru</h2>
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="text-sm font-medium text-gray-700">Nama Partner</label>
                    <input type="text" name="name"
                        class="w-full px-3 py-2 border rounded-lg mt-1 outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-700">Logo Berkas</label>
                    <input type="file" name="logo" class="w-full text-xs mt-1 block" required>
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg cursor-pointer hover:bg-blue-700 transition">Simpan</button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md md:col-span-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-xs text-gray-700 uppercase">
                        <th class="p-3">Logo</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partners as $ptr)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3">
                                <img src="{{ $ptr->logo_asset_url }}"
                                    class="h-8 w-16 object-contain bg-gray-50 border p-1 rounded">
                            </td>
                            <td class="p-3 font-semibold text-gray-800">{{ $ptr->name }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('admin.partners.edit', $ptr->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded text-xs font-medium hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('admin.partners.destroy', $ptr->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus partner ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-xs font-medium cursor-pointer hover:bg-red-600 transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center p-4 text-gray-400 text-sm">Data partner tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
