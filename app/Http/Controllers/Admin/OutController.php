<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Out;
use App\Models\Enter;
use App\Exports\OutExport;


class OutController extends Controller
{
    

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $outs = Out::whereBetween('date', [$startDate, $endDate])->latest()->paginate(5);
            $moneyOut = Out::whereBetween('date', [$startDate, $endDate])->sum('balance');
            $moneyIn = Enter::whereBetween('date', [$startDate, $endDate])->sum('balance');
        } else {
            $outs = Out::latest()->paginate(5);
            $moneyOut = Out::sum('balance');
            $moneyIn = Enter::sum('balance');
        }
    
        // Calculate total balance (money in - money out)
        $totalBalance = $moneyIn - $moneyOut;
    
        // Pass data to the view
        return view('admin.out.index', compact('outs', 'moneyOut', 'moneyIn', 'totalBalance'));
    }
    
    public function create()
    {
        return view('admin.out.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'balance' => 'required',
            'date' => 'date',
        ]);

        $total = Out::sum('balance');
        
        $outs = Out::create([
            'name' => $request->input('name'),
            'balance' => $request->input('balance'),
            'date' => $request->input('date'),
            'total' => $total,
        ]);

        if ($outs) {
            return redirect()->route('out.index')->with(['success' => 'Data Berhasil']);
        }else {
            return redirect()->route('out.create')->with(['error' => 'gagal']);
        }
    }

    public function edit(Out $out)
    {
        return view('admin.out.edit', compact('out'));
    }

    public function update(Request $request, Out $out)
    {
        $this->validate($request, [
            'name' => 'required',
            'balance' => 'required',
            'date' => 'date',
        ]);
        
        $out = Out::findOrFail($out->id);
        $out->update([
            'name' => $request->input('name'),
            'balance' => $request->input('balance'),
            'date' => $request->input('date'),
        ]);

        if ($out) {
            return redirect()->route('out.index')->with(['success' => 'Data Berhasil']);
        }else {
            return redirect()->route('out.index')->with(['error' => 'gagal']);
        }

    }

    public function destroy($id)
    {
        $out = Out::findOrFail($id);
        $out->delete();

        if ($out) {
            return redirect()->route('out.index')->with(['success' => 'Data Berhasil']);
        }else {
            return redirect()->route('out.index')->with(['error' => 'gagal']);
        }
    }

    public function export()
    {
        $export = new OutExport();
        return $export->export();
    }

}