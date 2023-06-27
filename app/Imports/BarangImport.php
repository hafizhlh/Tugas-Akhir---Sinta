<?php

namespace App\Imports;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow, ShouldAutoSize
{
    public function model(array $row)
    {
        $kategori = DB::table('kategoris')->where('nama_kategori', $row['kategori_barang'])->first();
        return new Barang([
            'nama_barang' => strtoupper($row['nama_barang']),
            'kategori_id' => $kategori->id,
            'barcode_barang' => $row['kode_barang'],
            'keterangan_barang' => $row['keterangan_barang'],
            'user_id' => Auth::user()->id,
            'delete_mark' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
