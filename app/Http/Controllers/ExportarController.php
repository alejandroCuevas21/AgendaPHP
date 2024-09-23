<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExportarController extends Controller
{

public function ExportarExcel() {

    $agendas = Agenda::all(); 

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

  
    $sheet->setCellValue('A1', 'Nombre');
    $sheet->setCellValue('B1', 'Calle');
    $sheet->setCellValue('C1', 'Numero');
    $sheet->setCellValue('D1', 'Colonia');
    $sheet->setCellValue('E1', 'Ciudad');


// Apply background color to the header row
$headerStyle = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'color' => ['argb' => Color::COLOR_YELLOW], // Change color as needed
    ],
    'font' => [
        'bold' => true,
    ],
];


$sheet->getStyle('A1:E1')->applyFromArray($headerStyle);
 
    $row = 2; 
    foreach ($agendas as $index => $agenda) {
 
        $sheet->setCellValue('A' . $row, $agenda->Nombre); 
        $sheet->setCellValue('B' . $row, $agenda->Domicilio); 
        $sheet->setCellValue('C' . $row, $agenda->Numero); 
        $sheet->setCellValue('D' . $row, $agenda->Colonia); 
        $sheet->setCellValue('D' . $row, $agenda->Ciudad); 
        $row++;
    }

    $writer = new Csv($spreadsheet);
    $fileName = "ExportarAgendas.csv";


    header("Content-Type: text/csv");
    header("Content-Disposition: attachment;filename=\"$fileName\"");
    header("Cache-Control: max-age=0");

    $writer->save("php://output");
    exit();
}
}
