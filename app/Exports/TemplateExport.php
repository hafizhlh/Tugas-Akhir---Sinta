<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TemplateExport implements  WithHeadings, WithValidation, WithStyles,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function headings(): array
    {
        return [
            'nama_barang',
            'kode_barang',
            'kategori_barang',            
            'keterangan_barang',
        ];
    }

    //validation C coloumn dropdown  
    public function rules(): array
    {
        return [
            'A' => 'required',
            'B' => 'required',
            'C' => 'required',
            'D' => 'required',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleContentCenteredBold = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ];
        $kategori=DB::table('kategoris')->get()->pluck('nama_kategori')->toArray();
        $sheet->getStyle('C2')->applyFromArray($styleContentCenteredBold)->getAlignment()->setWrapText(true);
        //get datavalidation entire column c
        $lstKategori=$sheet->getDataValidation('C2:C1000');

        
        // $lstKategori=$sheet->getCell')->getDataValidation();
        $lstKategori->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)->setShowDropDown(true);
        $lstKategori->setFormula1('"'.implode(',',$kategori).'"');
    }


}
