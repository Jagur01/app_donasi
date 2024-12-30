<?php

namespace App\Http\Controllers;

use App\Models\CategoriesCampaigns;
use Illuminate\Http\Request;

class CategoriesCampaignController extends Controller
{
    // Menampilkan daftar kategori kampanye
    public function index()
    {
        $categoriesCampaigns = CategoriesCampaigns:: orderByRaw("TRIM(name) ASC")->get();
        return view('categoriesCampaigns.index', compact('categoriesCampaigns'));
    }

    // Menampilkan form untuk membuat kategori kampanye baru
    public function create()
    {
        return view('categoriesCampaigns.create');
    }

    // Menyimpan kategori kampanye baru
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nama kategori kampanye wajib diisi
        ]);

        // Membuat kategori kampanye baru
        CategoriesCampaigns::create($validated);

        return redirect()->route('categoriesCampaigns.index')->with('success', 'Kategori kampanye berhasil dibuat!');
    }

    // Menampilkan form untuk mengedit kategori kampanye
    public function edit(CategoriesCampaigns $categoriesCampaign)
    {
        return view('categoriesCampaigns.edit', compact('categoriesCampaign'));
    }

    // Memperbarui kategori kampanye
    public function update(Request $request, CategoriesCampaigns $categoriesCampaign)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nama kategori wajib diisi
        ]);

        // Update kategori kampanye
        $categoriesCampaign->update($validated);

        return redirect()->route('categoriesCampaigns.index')->with('success', 'Kategori kampanye berhasil diperbarui!');
    }

    // Menghapus kategori kampanye
    public function destroy($id)
    {
        $categoriesCampaign = CategoriesCampaigns::findOrFail($id);
        $categoriesCampaign->delete();

        return redirect()->route('categoriesCampaigns.index')->with('success', 'Kategori kampanye berhasil dihapus!');
    }
}
