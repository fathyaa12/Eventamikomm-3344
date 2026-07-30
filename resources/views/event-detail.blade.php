@extends('layouts.app')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
    <!-- Left: Poster -->
    <div class="lg:col-span-1">
        <div class="sticky top-32">
            @if($event->poster_path)
                <img src="{{ str_starts_with($event->poster_path, 'http') ? $event->poster_path : asset('storage/' . $event->poster_path) }}"
                     alt="{{ $event->title }}"
                     class="w-full rounded-[2.5rem] shadow-2xl border-8 border-white object-cover aspect-[3/4]">
            @else
                <img src="{{ asset('assets/concert.png') }}"
                     alt="{{ $event->title }}"
                     class="w-full rounded-[2.5rem] shadow-2xl border-8 border-white object-cover aspect-[3/4]">
            @endif

            <div class="mt-8 p-6 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <h4 class="font-bold mb-4">Penyelenggara</h4>

                <div class="flex items-center gap-4">
                    @if($event->user && $event->user->avatar)
                        <img src="{{ $event->user->avatar }}" alt="avatar" class="w-12 h-12 rounded-full border">
                    @else
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-lg">
                            {{ $event->user ? strtoupper(substr($event->user->name, 0, 2)) : 'AH' }}
                        </div>
                    @endif

                    <div>
                        <p class="font-bold text-slate-800 flex items-center gap-2">
                            {{ $event->user ? $event->user->name : 'AmikomEventHub' }}
                            @if($event->user && $event->user->role === 'organizer' && $event->user->status === 'active')
                                <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-md font-bold">✓ Verified</span>
                            @endif
                        </p>
                        <p class="text-xs text-slate-500">{{ $event->user ? 'Verified Organizer' : 'Official Platform' }}</p>
                    </div>
                </div>

                {{-- Statistik penyelenggara --}}
                @if($event->user)
                    @php
                        $organizerEvents = $event->user->events()->count();
                        $organizerAvgRating = \App\Models\Review::whereIn('event_id', $event->user->events()->pluck('id'))->avg('rating');
                        $organizerTotalReviews = \App\Models\Review::whereIn('event_id', $event->user->events()->pluck('id'))->count();
                    @endphp
                    <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-3 gap-2 text-center">
                        <div>
                            <p class="text-lg font-black text-indigo-600">{{ $organizerEvents }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase">Event</p>
                        </div>
                        <div>
                            <p class="text-lg font-black text-amber-500">{{ $organizerAvgRating ? number_format($organizerAvgRating, 1) : '-' }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase">Rating</p>
                        </div>
                        <div>
                            <p class="text-lg font-black text-green-600">{{ $organizerTotalReviews }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase">Ulasan</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right: Details -->
    <div class="lg:col-span-2 space-y-12">
        <div class="space-y-4">
            <span class="px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
                {{ $event->category->name ?? 'Event' }}
            </span>

            <div class="flex items-center gap-4">
                <h1 class="text-4xl md:text-5xl font-black leading-tight">
                    {{ $event->title }}
                </h1>
                
                @if($event->average_rating > 0)
                    <div class="flex items-center gap-1 bg-amber-100 text-amber-600 px-3 py-1 rounded-lg">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="font-bold">{{ $event->average_rating }}</span>
                        <span class="text-sm">({{ $event->reviews->count() }})</span>
                    </div>
                @endif
            </div>

            <div class="flex flex-wrap gap-6 text-slate-500 font-medium">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>

                    <span>
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                    </span>
                </div>

                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>

                    <span>{{ $event->location }}</span>
                </div>
            </div>
        </div>

        <div class="prose prose-slate max-w-none">
            <h3 class="text-2xl font-bold mb-4">Deskripsi Event</h3>

            <p class="text-lg text-slate-600 leading-relaxed">
                {{ $event->description ?? 'Belum ada deskripsi event.' }}
            </p>
        </div>

        <div class="bg-indigo-600 rounded-[2.5rem] p-8 md:p-12 text-white shadow-2xl shadow-indigo-200 relative overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                <div>
                    <p class="text-indigo-200 font-bold uppercase tracking-widest text-sm mb-2">
                        Harga Tiket @if($event->active_tier) ({{ $event->active_tier->name }}) @endif
                    </p>

                    <h2 class="text-5xl font-black">
                        Rp {{ number_format($event->current_price, 0, ',', '.') }}
                        <span class="text-lg font-medium text-indigo-200">/ orang</span>
                    </h2>

                    @if($event->active_tier && $event->active_tier->end_date)
                        <p class="mt-2 text-sm text-indigo-200">
                            Berlaku hingga: {{ \Carbon\Carbon::parse($event->active_tier->end_date)->format('d M Y, H:i') }}
                        </p>
                    @endif

                    <p class="mt-4 text-indigo-100 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>

                        Sisa stok:
                        <span class="font-bold underline">
                            {{ $event->stock }} Tiket lagi!
                        </span>
                    </p>
                </div>

                <div>
                    <a href="{{ route('checkout.create', $event->id) }}"
                       class="inline-block w-full text-center py-4 px-8 bg-white text-indigo-600 rounded-2xl font-black hover:bg-indigo-50 transition">
                        Pesan Sekarang
                    </a>
                </div>
            </div>

            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-white opacity-10 rounded-full"></div>
            <div class="absolute -left-10 -top-10 w-32 h-32 bg-indigo-400 opacity-20 rounded-full"></div>
        </div>

        <div class="space-y-4">
            <h3 class="text-xl font-bold">Kebijakan Tiket</h3>

            <ul class="space-y-3 text-slate-500">
                <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                    E-Ticket akan dikirimkan otomatis setelah pembayaran berhasil.
                </li>

                <li class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                    Tiket dapat discan di pintu masuk.
                </li>

                <li class="flex items-start gap-2 text-rose-500">
                    <svg class="w-5 h-5 text-rose-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    Tiket yang sudah dibeli tidak dapat direfund.
                </li>
            </ul>
        </div>
        <div class="space-y-4 pt-8 border-t">
            <h3 class="text-2xl font-bold">Ulasan & Rating ({{ $event->reviews->count() }})</h3>
            
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-xl font-bold">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-xl font-bold">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-xl font-bold">
                    {{ $errors->first() }}
                </div>
            @endif

            @php
                $canReview = false;
                if(auth()->check() && $event->date < now()->subDay()) {
                    $hasPurchased = \App\Models\Transaction::where('event_id', $event->id)
                        ->where('customer_email', auth()->user()->email)
                        ->where('status', 'success')
                        ->exists();
                        
                    $hasReviewed = $event->reviews()->where('user_id', auth()->id())->exists();
                    
                    if($hasPurchased && !$hasReviewed) {
                        $canReview = true;
                    }
                }
            @endphp

            @if($canReview)
                <div class="bg-indigo-50 p-6 rounded-2xl mb-8">
                    <h4 class="font-bold text-indigo-900 mb-4">Berikan Ulasan Anda</h4>
                    <form action="{{ route('reviews.store', $event->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block font-medium mb-2">Rating Bintang</label>
                            <div class="flex gap-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="flex items-center gap-1 cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $i }}" class="w-4 h-4 text-indigo-600" required>
                                        {{ $i }} Bintang
                                    </label>
                                @endfor
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium mb-2">Testimoni (Opsional)</label>
                            <textarea name="comment" rows="3" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Ceritakan pengalaman Anda..."></textarea>
                        </div>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-indigo-700">Kirim Ulasan</button>
                    </form>
                </div>
            @endif

            <div class="space-y-6">
                @forelse($event->reviews as $review)
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                @if($review->user->avatar)
                                    <img src="{{ $review->user->avatar }}" class="w-10 h-10 rounded-full">
                                @else
                                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="font-bold text-slate-800">{{ $review->user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex gap-1 text-amber-400">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        @if($review->comment)
                            <p class="text-slate-600 italic">"{{ $review->comment }}"</p>
                        @endif
                    </div>
                @empty
                    <div class="text-center p-8 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                        <p class="text-slate-500 font-medium">Belum ada ulasan untuk event ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection
