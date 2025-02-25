<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donation::with('user:id,name,email,phone')
            ->select('user_id')
            ->groupBy('user_id')
            ->get();

        return view('donors', compact('donors'));
    }
}

