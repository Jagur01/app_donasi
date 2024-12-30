<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enter;
use App\Models\Out;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class EnterOutController extends Controller
{
    // Method to display enter and out data in JSON format based on the latest data
    public function index()
    {
        try {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            // Fetching 'Enter' data
            $enter = Enter::whereMonth('created_at', $currentMonth)
                          ->whereYear('created_at', $currentYear)
                          ->orderBy('created_at', 'desc')
                          ->get(['id', 'name', 'balance', 'created_at']); // Specify fields to return

            // Fetching 'Out' data
            $out = Out::whereMonth('created_at', $currentMonth)
                      ->whereYear('created_at', $currentYear)
                      ->orderBy('created_at', 'desc')
                      ->get(['id', 'name', 'balance', 'created_at']); // Specify fields to return
            
            // Prepare the response data
            $data = [
                'enter' => $enter,
                'out' => $out
            ];
            
            return response()->json($data, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching enter and out data: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to fetch data'], 500);
        }
    }
}