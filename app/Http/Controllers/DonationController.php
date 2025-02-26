<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class DonationController extends Controller
{
    public function index()
    {
        // Fetch all donations and pass them to the view
        $donations = Donation::with('campaign')->get(); // Eager load the campaign relationship
        return view('donations.index', compact('donations'));
    }

    public function create(Campaign $campaign)
    {
        // Show the donation creation form for a specific campaign
        return view('donations.create', compact('campaign'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1', // Ensure amount is a positive number
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'campaign_id' => 'required|exists:campaigns,id', // Ensure the campaign exists
        ]);

        // Store the proof image
        $validated['proof_image'] = $request->file('proof_image')->store('donation_proofs', 'public');

        // Create a new donation record
        $donation = new Donation();
        $donation->user_id = Auth::id(); // Get the ID of the currently authenticated user
        $donation->campaign_id = $validated['campaign_id']; // Set the campaign ID
        $donation->amount = $validated['amount']; // Set the donation amount
        $donation->proof_image = $validated['proof_image']; // Set the proof image path
        $donation->save();

        // // Check if the campaign goal is reached and update its status
        // $campaign = Campaign::find($donation->campaign_id);
        // $campaign->save();

        if ($request->ajax()) {
            return response()->json(['message' => 'Donasi Berhasil Dikirim!'], 200);
        }

        return redirect()->route('donations.index')->with('success', 'Donasi Berhasil Dikirim!');
    }

    public function show(Donation $donation)
    {
        return view('donations.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        // Show the edit form for a specific donation
        return view('donations.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required|numeric|min:1',
            'proof_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the donation amount
        $donation->amount = $validated['amount'];

        // Check if a new proof image is uploaded
        if ($request->hasFile('proof_image')) {
            // Store the new proof image
            $validated['proof_image'] = $request->file('proof_image')->store('donation_proofs', 'public');
            $donation->proof_image = $validated['proof_image']; // Update the proof image path
        }

        // Update the campaign ID if it has changed
        if ($donation->campaign_id !== $validated['campaign_id']) {
            $donation->campaign_id = $validated['campaign_id'];
        }

        // Save the updated donation
        $donation->save();

        return redirect()->route('donations.index')->with('success', 'Donasi berhasil diupdate!');
    }
    public function destroy(Donation $donation)
    {
        // Delete the donation record
        $donation->delete();
        return redirect()->route('donations.index')->with('success', 'Donasi berhasil dihapus!');
    }
    public function approve(Donation $donation)
    {
        // Check if the donation is already approved
        if ($donation->status_id == 2) {
            return redirect()->route('donations.index')->with('info', 'Donation is already approved.');
        }

        // Update the donation status to approved (2)
        $donation->status_id = 2;

        // Update the total collected amount for the campaign
        $campaign = Campaign::find($donation->campaign_id);
        $campaign->total_collected += $donation->amount;
        $campaign->save();

        // Save the updated donation
        $donation->save();

        return redirect()->route('donations.index')->with('success', 'Donasi berhasil disetujui!');
    }

    public function reject(Donation $donation)
    {
        // Cek kalau donasi sudah ditolak
        if ($donation->status_id == 3) {
            return redirect()->route('donations.index')->with('info', 'Donasi sudah ditolak sebelumnya.');
        }

        // Update status jadi ditolak (3)
        $donation->status_id = 3;
        $donation->save();

        return redirect()->route('donations.index')->with('success', 'Donasi berhasil ditolak.');
    }

    public function history()
    {
        $donations = Donation::where('user_id', Auth::id())->with('campaign')->get();
        return view('history', compact('donations'));
    }

    public function download(Donation $donation)
    {
        // $donation = Donation::findOrFail($donation->id);
        $donation = Donation::findOrFail($donation->id)->refresh();

        // Data yang akan dimasukkan ke dalam PDF
        $data = [
            'donor' => Auth::user()->name,
            'amount' => $donation->amount,
            'campaign' => $donation->campaign->title,
            'date' => $donation->created_at->format('d M Y'),
            // 'status' => $donation->status_id == 2 ? 'Disetujui' : 'Pending',
            'status' => $donation->status->name
        ];

        // Generate PDF menggunakan view 'receipt'
        $pdf = Pdf::loadView('receipt', $data);

        return $pdf->download('bukti_donasi.pdf');
    }

    public function certificate(Donation $donation)
    {
        // $donation = Donation::findOrFail($donation->id);
        $donation = Donation::findOrFail($donation->id)->refresh();


        // Data yang akan dimasukkan ke dalam PDF
        $data = [
            'donor' => Auth::user()->name,
            'amount' => $donation->amount,
            'campaign' => $donation->campaign->title,
            'date' => $donation->created_at->format('d M Y'),
            // 'status' => $donation->status_id == 2 ? 'Disetujui' : 'Pending',
            'status' => $donation->status->name
        ];

        // Generate PDF menggunakan view 'certificate'
        $pdf = Pdf::loadView('certificate', $data);

        // Download PDF dengan nama file yang sesuai
        return $pdf->download('sertifikat_donasi_' . $donation->id . '.pdf');
    }
}
