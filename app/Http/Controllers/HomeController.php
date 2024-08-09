<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enter;
use App\Models\Out;
use Carbon\Carbon;
use App\Exports\EnterOutExport;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $currentMonth = Carbon::now()->month;
        // $currentYear = Carbon::now()->year;

        // Mengambil data sesuai bulan dan tahun sekarang
        $moneyOut = Out::whereMonth('date', now()->month)
                       ->whereYear('date', now()->year)
                       ->sum('total');
        $moneyIn = Enter::whereMonth('date', now()->month)
                        ->whereYear('date', now()->year)
                        ->sum('total');
        $total = $moneyIn - $moneyOut;
        return view('home', compact('moneyOut', 'moneyIn' ,'total'));
    }

    public function export()
    {
        return (new EnterOutExport)->export();
    }

}
