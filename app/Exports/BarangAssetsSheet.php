<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class BarangAssetsSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Tanggal Barang Keluar',
            'Tanggal Barang Return',
            'Nama User',
            'No DOF Etiket',
            'Nama Barang',
            'Jenis Barang',
            'Nama Kategori',
            'Jumlah Barang Keluar',
            'Jumlah Barang Return',
            'Jumlah Stok Barang Saat Ini',
            'Keterangan Barang',
        ];
    }

    public function title(): string
    {
        return 'Barang Assets';
    }
}
