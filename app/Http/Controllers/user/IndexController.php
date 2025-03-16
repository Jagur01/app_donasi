<?php

namespace App\Http\Controllers\User;

use App\Models\Campaign;
use App\Models\CategoriesCampaigns;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    // Method untuk menampilkan halaman index
    public function index()
    {
        // $redirectUrl = Cookie::get('redirect_url');
        // if ($redirectUrl) {
        //     return redirect()->to('/donationuser/create/' . $redirectUrl);
        // } else {
        //     return redirect()->to('/indexs');
        // }
        // dd($redirectUrl);
        // Retrieve campaigns with their categories and calculate days left
        $campaigns = Campaign::with('category')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($campaign) {
                // Calculate days left until expiration
                $campaign->days_left = Carbon::now()->diffInDays(Carbon::parse($campaign->expired), true);
                return $campaign;
            });
// dd($campaigns->json());
        // Return the view with campaigns data
        return view('index', compact('campaigns'));
    }
}
