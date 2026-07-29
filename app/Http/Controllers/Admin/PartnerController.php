<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');

        $partners = Partner::when($search, function($query, $search) {
            return $query->where('name', 'LIKE', '%' . $search . '%');
        })->latest()->get();

        return view('admin.partners.index', compact('partners', 'search'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'logo_link' => 'nullable|url'
        ]);

        if (!$request->hasFile('logo') && !$request->logo_link) {
            return back()->withErrors(['logo' => 'Logo file atau URL logo harus diisi.'])->withInput();
        }

        $path = $request->logo_link;
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners', 'public');
        }

        Partner::create([
            'name' => $request->name,
            'logo_url' => $path
        ]);

        return redirect()->back()->with('success', 'Partner baru ditambahkan!');
    }


    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }


    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'logo_link' => 'nullable|url'
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('logo')) {
            // Delete old file if it was a file (not URL)
            if(!str_starts_with($partner->logo_url, 'http') && Storage::disk('public')->exists($partner->logo_url)) {
                Storage::disk('public')->delete($partner->logo_url);
            }
            $data['logo_url'] = $request->file('logo')->store('partners', 'public');
        } elseif ($request->filled('logo_link')) {
            // Delete old file if switching to URL
            if(!str_starts_with($partner->logo_url, 'http') && Storage::disk('public')->exists($partner->logo_url)) {
                Storage::disk('public')->delete($partner->logo_url);
            }
            $data['logo_url'] = $request->logo_link;
        }

        $partner->update($data);
        return redirect()->route('admin.partners.index')->with('success', 'Data Partner diperbarui!');
    }


    public function destroy(Partner $partner)
    {
        if(!str_starts_with($partner->logo_url, 'http') && Storage::disk('public')->exists($partner->logo_url)) {
            Storage::disk('public')->delete($partner->logo_url);
        }
        $partner->delete();
        return redirect()->back()->with('success', 'Partner berhasil dihapus!');
    }
}
