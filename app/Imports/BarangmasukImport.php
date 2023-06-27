<?php

namespace App\Imports;

use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangmasukImport implements ToModel, WithHeadingRow, ShouldAutoSize
{
    public function model(array $row)
    {
        // dd($row);
        $nama_barang = DB::table(
            'barangs'
        )->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->where('nama_barang', $row['nama_barang'])
            ->where('nama_kategori', $row['kategori_barang'])
            ->first();
        if ($nama_barang == null) {
            return null;
        }
        $barang_masuk = BarangMasuk::create([
            'tanggal_barang_masuk' => $row['tanggal_barang_masuk'],
            'delete_mark' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('barangs')->where('nama_barang', $row['nama_barang'])->update([
            'jumlah_barang' => $nama_barang->jumlah_barang + $row['jumlah_barang_masuk']
        ]);

        return new DetailBarangMasuk([
            'barang_masuk_id' => $barang_masuk->barang_masuk_id,
            'barang_id' => $nama_barang->barang_id,
            'jumlah_barang_masuk' => $row['jumlah_barang_masuk'],
            'user_id' => Auth::user()->id,
            'delete_mark' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
