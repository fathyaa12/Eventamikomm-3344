<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'organizer') {
            $events = Event::with('category')->where('user_id', $user->id)->latest()->get();
        } else {
            $events = Event::with('category')->latest()->get();
        }
        $categories = Category::all();

        return view('admin.events.index', compact('events', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'poster' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:40960',
        ]);

        if ($request->hasFile('poster')) {
            \Cloudinary\Configuration\Configuration::instance(env('CLOUDINARY_URL'));
            $upload = new \Cloudinary\Api\Upload\UploadApi();
            $response = $upload->upload($request->file('poster')->getRealPath(), [
                'folder' => 'posters'
            ]);
            $data['poster_path'] = $response['secure_url'];
        }

        // Set ownership of the event
        $data['user_id'] = auth()->id();

        Event::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->user_id !== $user->id) {
            abort(403, 'Akses ditolak. Ini bukan event Anda.');
        }

        $categories = Category::all();

        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->user_id !== $user->id) {
            abort(403, 'Akses ditolak. Anda tidak bisa mengubah event ini.');
        }

        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'poster' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($request->hasFile('poster')) {
            if ($event->poster_path && !str_starts_with($event->poster_path, 'http') && Storage::disk('public')->exists($event->poster_path)) {
                Storage::disk('public')->delete($event->poster_path);
            }

            \Cloudinary\Configuration\Configuration::instance(env('CLOUDINARY_URL'));
            $upload = new \Cloudinary\Api\Upload\UploadApi();
            $response = $upload->upload($request->file('poster')->getRealPath(), [
                'folder' => 'posters'
            ]);
            $data['poster_path'] = $response['secure_url'];
        }

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->user_id !== $user->id) {
            abort(403, 'Akses ditolak. Anda tidak bisa menghapus event ini.');
        }

        if ($event->poster_path && !str_starts_with($event->poster_path, 'http') && Storage::disk('public')->exists($event->poster_path)) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}
