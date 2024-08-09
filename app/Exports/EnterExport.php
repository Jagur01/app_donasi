<?php
namespace App\Exports;

use App\Models\Enter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EnterExport
{
    public function export()
    {
        $enters = Enter::latest()->get();

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
        foreach ($enters as $enter) {
            $sheet->setCellValue('A' . $row, $enter->id);
            $sheet->setCellValue('B' . $row, $enter->name);
            $sheet->setCellValue('C' . $row, $enter->balance);
            $sheet->setCellValue('D' . $row, $enter->date);
            $sheet->setCellValue('E' . $row, $enter->total);
            $sheet->setCellValue('F' . $row, $enter->created_at);
            $sheet->setCellValue('G' . $row, $enter->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Kas Masuk.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
