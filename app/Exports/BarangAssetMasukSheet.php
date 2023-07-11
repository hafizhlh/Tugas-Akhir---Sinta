<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class BarangAssetMasukSheet implements FromCollection, WithHeadings, WithTitle,ShouldAutoSize
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
            'Tanggal Barang Masuk',           
             'Nama Barang',          
             'Jenis Barang',
             'Kategori Barang',
             'Jumlah Barang Masuk',
             'Jumlah Stok barang saat ini',
             'Keterangan barang'
 
        ];
    }

    public function title(): string
    {
        return 'Barang Assets masuk';
    }
}
