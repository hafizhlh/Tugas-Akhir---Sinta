<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class TemplateMasukExport implements WithHeadings, WithStyles, ShouldAutoSize
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {z
    //     //
    // }

    public function headings(): array
    {
        return [
            'kategori_barang',
            'nama_barang',
            'jumlah_barang_masuk',
            'tanggal_barang_masuk',
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
        $sheet->getStyle('A2')->applyFromArray($styleContentCenteredBold)->getAlignment()->setWrapText(true);
        //get datavalidation entire column a
        $lstKategori=$sheet->getDataValidation('A2:A1000');

        //set dropdown list
        $lstKategori->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
        $lstKategori->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
        $lstKategori->setAllowBlank(false);
        $lstKategori->setShowInputMessage(true);
        $lstKategori->setShowErrorMessage(true);
        $lstKategori->setShowDropDown(true);
        $lstKategori->setErrorTitle('Input error');
        $lstKategori->setError('Value is not in list.');
        $lstKategori->setPromptTitle('Pick from list');
        $lstKategori->setPrompt('Please pick a value from the drop-down list.');
        $lstKategori->setFormula1('"'.implode(',',$kategori).'"');

       

        


        

         
                $styleContentCenteredBold = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    ]
                ];
               
               

               
            
    }
}
