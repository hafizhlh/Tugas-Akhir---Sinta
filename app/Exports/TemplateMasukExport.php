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
    // {
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
        $kategori = DB::table('kategoris')->get()->pluck('nama_kategori')->toArray();
        $sheet->getStyle('A2')->applyFromArray($styleContentCenteredBold)->getAlignment()->setWrapText(true);
        //get datavalidation entire column A
        $lstKategori = $sheet->getDataValidation('A2:A1000');
        $lstKategori->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)->setShowDropDown(true);
        $lstKategori->setFormula1('"' . implode(',', $kategori) . '"');

        $Nama_barang = DB::table('barangs')
            ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->get()->pluck('nama_barang')->toArray();
        $sheet->getStyle('B2')->applyFromArray($styleContentCenteredBold)->getAlignment()->setWrapText(true);
        //get datavalidation entire column B
        $lstNamaBarang = $sheet->getDataValidation('B2:B1000');
        $lstNamaBarang->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST)->setShowDropDown(true);
        $lstNamaBarang->setFormula1('"' . implode(',', $Nama_barang) . '"');
    }
}
