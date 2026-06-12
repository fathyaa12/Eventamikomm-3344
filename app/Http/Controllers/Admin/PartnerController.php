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
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);


        $path = $request->file('logo')->store('public/partners');

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
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('logo')) {

            if(Storage::exists($partner->logo_url)) {
                Storage::delete($partner->logo_url);
            }
            $data['logo_url'] = $request->file('logo')->store('public/partners');
        }

        $partner->update($data);
        return redirect()->route('admin.partners.index')->with('success', 'Data Partner diperbarui!');
    }


    public function destroy(Partner $partner)
    {
        if(Storage::exists($partner->logo_url)) {
            Storage::delete($partner->logo_url);
        }
        $partner->delete();
        return redirect()->back()->with('success', 'Partner berhasil dihapus!');
    }
}
