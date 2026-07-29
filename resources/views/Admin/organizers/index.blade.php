@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-800">Kelola Penyelenggara (HIMA / Kepanitiaan)</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="p-4 font-bold text-slate-600 text-sm">Nama Organisasi</th>
                    <th class="p-4 font-bold text-slate-600 text-sm">Email</th>
                    <th class="p-4 font-bold text-slate-600 text-sm">Status</th>
                    <th class="p-4 font-bold text-slate-600 text-sm">Jumlah Event</th>
                    <th class="p-4 font-bold text-slate-600 text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($organizers as $org)
                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                        <td class="p-4 font-semibold text-slate-800">{{ $org->name }}</td>
                        <td class="p-4 text-slate-600">{{ $org->email }}</td>
                        <td class="p-4">
                            @if($org->status === 'active')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase">Aktif</span>
                            @elseif($org->status === 'pending')
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold uppercase">Tertunda</span>
                            @else
                                <span class="px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-bold uppercase">Ditangguhkan</span>
                            @endif
                        </td>
                        <td class="p-4 text-slate-600 font-medium">{{ $org->events->count() }} Event</td>
                        <td class="p-4">
                            <form action="{{ route('admin.organizers.update-status', $org->id) }}" method="POST" class="inline-flex gap-2">
                                @csrf
                                @method('PATCH')
                                
                                @if($org->status !== 'active')
                                    <button type="submit" name="status" value="active" class="px-3 py-1.5 bg-green-600 text-white rounded-lg text-xs font-bold hover:bg-green-700 transition">
                                        Aktifkan
                                    </button>
                                @endif
                                
                                @if($org->status !== 'suspended')
                                    <button type="submit" name="status" value="suspended" class="px-3 py-1.5 bg-rose-600 text-white rounded-lg text-xs font-bold hover:bg-rose-700 transition">
                                        Tangguhkan
                                    </button>
                                @endif
                                
                                @if($org->status !== 'pending')
                                    <button type="submit" name="status" value="pending" class="px-3 py-1.5 bg-slate-500 text-white rounded-lg text-xs font-bold hover:bg-slate-600 transition">
                                        Tunda
                                    </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-400 italic">Belum ada penyelenggara yang mendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $organizers->links() }}
    </div>
</div>
@endsection
