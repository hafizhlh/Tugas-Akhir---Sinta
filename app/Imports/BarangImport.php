<?php

namespace App\Imports;

use App\Models\Barang;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class BarangImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row){
        DB::table('barangs')
            ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ([
                'jenis_barang' => $row[0], // Sesuaikan nama kolomnya, bila lebih dari 1 tinggal copy aja di bawahnya terus ganti [1] nya jadi [2] dst
                'nama_katagori' => $row[1],
                'nama_barang' => $row[2],
                'foto_barang' => $row[3],
                'keterangan_barang' => $row[4],

            ]);
        }
    }
    public function model(array $row){
        return new Barang([
            'jenis_barang' => $row[0], // Sesuaikan nama kolomnya, bila lebih dari 1 tinggal copy aja di bawahnya terus ganti [1] nya jadi [2] dst
            'nama_katagori' => $row[1],
            'nama_barang' => $row[2],
            'foto_barang' => $row[3],
         'keterangan_barang' => $row[4],
        ]);
        
    }
    public function headingRow(): int
        {
            return 1;
        }

}
