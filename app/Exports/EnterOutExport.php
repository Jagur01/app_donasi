<?php 

namespace App\Exports;

use App\Models\Enter;
use App\Models\Out;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class EnterOutExport
{
    public function export()
    {
        // Ambil data uang masuk dan keluar bulan ini
        $enters = Enter::whereMonth('date', now()->month)->whereYear('date', now()->year)->get();
        $outs = Out::whereMonth('date', now()->month)->whereYear('date', now()->year)->get();

        // Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Sheet Uang Masuk
        $enterSheet = $spreadsheet->createSheet(0);
        $enterSheet->setTitle('Uang Masuk');
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

        // Sheet Uang Keluar
        $outSheet = $spreadsheet->createSheet(1);
        $outSheet->setTitle('Uang Keluar');
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

        // Sheet Total
        $totalSheet = $spreadsheet->createSheet(2);
        $totalSheet->setTitle('Total');
        $totalSheet->setCellValue('A1', 'Deskripsi');
        $totalSheet->setCellValue('B1', 'Total');
        $totalSheet->setCellValue('A2', 'Total Uang Masuk');
        $totalSheet->setCellValue('B2', $enters->sum('balance'));
        $totalSheet->setCellValue('A3', 'Total Uang Keluar');
        $totalSheet->setCellValue('B3', $outs->sum('balance'));
        $totalSheet->setCellValue('A4', 'Net Total');
        $totalSheet->setCellValue('B4', $enters->sum('balance') - $outs->sum('balance'));

        // Simpan File di Path yang Aman
        $directory = storage_path('app/Kas_Masjid_Bulan_Sekarang');
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $fileName = $directory . '/data.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);

        // Return File untuk Unduhan
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
