<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    // ini untuk mengecek apakah user sudah login atau belum
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('index');
    }
}
