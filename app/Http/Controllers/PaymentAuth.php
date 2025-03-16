<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentAuth extends Controller
{
    public function paymentAuth($id)
    {
        if (Auth::check()) {
            return redirect()->route('donationuser.create', $id);
        }
    
        // Simpan URL tujuan di session
        session(['redirect_url' => route('donationuser.create', $id)]);
    
        return redirect()->route('login');
    }
}