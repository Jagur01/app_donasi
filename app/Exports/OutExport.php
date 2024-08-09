<?php
namespace App\Exports;

use App\Models\Out;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OutExport
{
    public function export()
    {
        $outs = Out::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Balance');
        $sheet->setCellValue('D1', 'Date');
        $sheet->setCellValue('E1', 'Total');
        $sheet->setCellValue('F1', 'Created At');
        $sheet->setCellValue('G1', 'Updated At');

        $row = 2;
        foreach ($outs as $out) {
            $sheet->setCellValue('A' . $row, $out->id);
            $sheet->setCellValue('B' . $row, $out->name);
            $sheet->setCellValue('C' . $row, $out->balance);
            $sheet->setCellValue('D' . $row, $out->date);
            $sheet->setCellValue('E' . $row, $out->total);
            $sheet->setCellValue('F' . $row, $out->created_at);
            $sheet->setCellValue('G' . $row, $out->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'outs.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
