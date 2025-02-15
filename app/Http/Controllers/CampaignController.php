<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CategoriesCampaigns;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();

        // Menguabah Format tanggal Langsung Di Controller
        foreach ($campaigns as $campaign) {
        $campaign->created_at = Carbon::parse($campaign->created_at)->format('d F Y');
        $campaign->expired = Carbon::parse($campaign->expired)->format('d F Y');
    }
    $campaigns = Campaign::with('category')->get();
    return view('campaigns.index', compact('campaigns'));
}

    public function create()
    {
        $categories = CategoriesCampaigns::all();
        return view('campaigns.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
           'file_qr' => 'required|image|max:2048',
            'goal_amount' => 'required|numeric|min:1',
            'description' => 'required|string',
            'expired' => 'required|date',
            'category_id' => 'required|exists:categories_campaign,id', // Ensure the table name is correct
        ]);

        $validated['slug'] = Str::slug($request->title, '-');
        $validated['image'] = $request->file('image')->store('campaign_images', 'public');
        $validated['file_qr'] = $request->file('file_qr')->store('campaign_qr', 'public');
        if ($request->hasFile('file_qr')) {
            $validated['file_qr'] = $request->file('file_qr')->store('campaign_qr', 'public');
        } else {
            $validated['file_qr'] = 'default_qr.png';
        }
       
        Campaign::create($validated);

        return redirect()->route('campaigns.index')->with('success', 'Donasi berhasil dibuat!');
    }

    public function show(Campaign $campaign)
    {
        return view('campaigns.show', compact('campaign'));
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        $categories = CategoriesCampaigns::all();
        return view('campaigns.edit', compact('campaign', 'categories'));
    }

    public function update(Request $request, $id)
{
    $campaign = Campaign::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'image|max:2048',
        'file_qr' => 'image|max:2048',
        'goal_amount' => 'required|numeric|min:1',
        'description' => 'required|string',
        'expired' => 'required|date',
        'category_id' => 'required|exists:categories_campaign,id', // Pastikan nama tabel benar
    ]);

    // Update data campaign
    $campaign->title = $request->title;
    $campaign->goal_amount = $request->goal_amount;
    $campaign->description = $request->description;
    $campaign->expired = $request->expired;
    $campaign->slug = Str::slug($request->title, '-'); // Update slug
    $campaign->category_id = $request->category_id;
    
    // Update file_qr jika ada file baru
    if ($request->hasFile('file_qr')) {
        $validated['file_qr'] = $request->file('file_qr')->store('campaign_qr', 'public');
        $campaign->file_qr = $validated['file_qr'];
    }

    // Update image jika ada file baru
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('campaign_images', 'public');
        $campaign->image = $imagePath;
    }

    // Simpan perubahan
    $campaign->save();
  
    return redirect()->route('campaigns.index')->with('success', 'Donasi berhasil diperbarui!');
}

public function destroy($id){
    $campaign = Campaign::findOrFail($id);
    
    $campaign->donations()->delete();

    $campaign->delete();

    return redirect()->route('campaigns.index')->with('success', 'Donasi berhasil dihapus!');

}
}