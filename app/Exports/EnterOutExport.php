<?php 

namespace App\Exports;

use App\Models\Enter;
use App\Models\Out;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EnterOutExport
{
    public function export()
    {
        // Menampilkan data uang masuk dan uang keluar bedasarkan bulan dan tahun sekarang
        $enters = Enter::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->get();
        $outs = Out::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->get();

        $spreadsheet = new Spreadsheet();

        // Sheet for Enter
        $enterSheet = new Worksheet($spreadsheet, 'Uang Masuk');
        $spreadsheet->addSheet($enterSheet, 0);
        $enterSheet->setCellValue('A1', 'ID');
        $enterSheet->setCellValue('B1', 'Name');
        $enterSheet->setCellValue('C1', 'Balance');
        $enterSheet->setCellValue('D1', 'Date');
        $enterSheet->setCellValue('E1', 'Total');
        $enterSheet->setCellValue('F1', 'Created At');
        $enterSheet->setCellValue('G1', 'Updated At');

        $row = 2;
        foreach ($enters as $enter) {
            $enterSheet->setCellValue('A' . $row, $enter->id);
            $enterSheet->setCellValue('B' . $row, $enter->name);
            $enterSheet->setCellValue('C' . $row, $enter->balance);
            $enterSheet->setCellValue('D' . $row, $enter->date);
            $enterSheet->setCellValue('E' . $row, $enter->total);
            $enterSheet->setCellValue('F' . $row, $enter->created_at);
            $enterSheet->setCellValue('G' . $row, $enter->updated_at);
            $row++;
        }

        // Sheet for Out
        $outSheet = new Worksheet($spreadsheet, 'Uang Keluar');
        $spreadsheet->addSheet($outSheet, 1);
        $outSheet->setCellValue('A1', 'ID');
        $outSheet->setCellValue('B1', 'Name');
        $outSheet->setCellValue('C1', 'Balance');
        $outSheet->setCellValue('D1', 'Date');
        $outSheet->setCellValue('E1', 'Total');
        $outSheet->setCellValue('F1', 'Created At');
        $outSheet->setCellValue('G1', 'Updated At');

        $row = 2;
        foreach ($outs as $out) {
            $outSheet->setCellValue('A' . $row, $out->id);
            $outSheet->setCellValue('B' . $row, $out->name);
            $outSheet->setCellValue('C' . $row, $out->balance);
            $outSheet->setCellValue('D' . $row, $out->date);
            $outSheet->setCellValue('E' . $row, $out->total);
            $outSheet->setCellValue('F' . $row, $out->created_at);
            $outSheet->setCellValue('G' . $row, $out->updated_at);
            $row++;
        }

        // Sheet for Total
        $totalSheet = new Worksheet($spreadsheet, 'Total');
        $spreadsheet->addSheet($totalSheet, 2);
        $totalSheet->setCellValue('A1', 'Deskripsi');
        $totalSheet->setCellValue('B1', 'Total');

        // Menghitung total uang masuk dan keluar
        $totalMoneyIn = $enters->sum('balance');
        $totalMoneyOut = $outs->sum('balance');
        $netTotal = $totalMoneyIn - $totalMoneyOut;

        $totalSheet->setCellValue('A2', 'Total Uang Masuk');
        $totalSheet->setCellValue('B2', $totalMoneyIn);
        $totalSheet->setCellValue('A3', 'Total Uang Keluar');
        $totalSheet->setCellValue('B3', $totalMoneyOut);
        $totalSheet->setCellValue('A4', 'Net Total');
        $totalSheet->setCellValue('B4', $netTotal);

        $spreadsheet->removeSheetByIndex(3); // Remove the default sheet
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Kas Masjid bulan sekarang/.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
