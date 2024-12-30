<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Campaign;

use Illuminate\Support\Facades\Auth;

class DonationUserController extends Controller
{
    public function create(Campaign $campaign)
    {
        // Show the donation creation form for a specific campaign
        return view('DonationUser', compact('campaign'));
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

        // Check if the campaign goal is reached and update its status
        $campaign = Campaign::find($donation->campaign_id);
        $totalCollected = $campaign->donations()->sum('amount');
        if ($totalCollected >= $campaign->goal_amount) {
            $campaign->status = 'success';
        } else {
            $campaign->status = 'ongoing';
        }
        $campaign->save();

       return redirect()->route('indexs')->with('success', 'Donation made successfully!');
    }

    public function show(Donation $donation)
    {
        // Show the details of a specific donation
       
        return view('indexs', compact('donation'));
    }
}