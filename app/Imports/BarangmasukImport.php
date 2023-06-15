<?php

namespace App\Imports;

use CreateBarangMasuksTable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class BarangmasukImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row){
        DB::table('detail_barang_masuks')
            ->join('barang_masuks', 'detail_barang_masuks.barang_masuk_id', '=', 'barang_masuks.barang_masuk_id')
            ->join('barangs', 'detail_barang_masuks.barang_id', '=', 'barangs.barang_id')
            ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ([
                'jenis_barang' => $row[0], // Sesuaikan nama kolomnya, bila lebih dari 1 tinggal copy aja di bawahnya terus ganti [1] nya jadi [2] dst
                'nama_katagori' => $row[1],
                'nama_barang' => $row[2],
                'jumlah_barang' => $row[3],
                

            ]);
        }
    }
}
