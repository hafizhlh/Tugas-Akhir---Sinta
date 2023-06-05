<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Company;
use App\Models\DetailBarangKeluar;
use App\Models\Interco;
use App\Models\IntercoPeriode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {

        $data['menus'] = $this->getDashboardMenu();
        $data['pie'] = DB::table('barangs')
        ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
        ->selectRaw( 'count(*) as total')->groupBy('kategoris.jenis_barang')->orderBy('total', 'asc')
        ->get();
        $data['topc'] = DB::table('detail_barang_keluars')
        ->join('barangs', 'detail_barang_keluars.barang_id', '=', 'barangs.barang_id')
        ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
        ->selectRaw("count('detail_barang_keluars.barang_id') as total, barangs.nama_barang, kategoris.jenis_barang")
        ->where('kategoris.jenis_barang', '1')
        ->groupBy('detail_barang_keluars.barang_id', 'barangs.nama_barang', 'kategoris.jenis_barang')
        ->orderBy('total', 'desc')
        ->take(5) //memberikan limit 5 baris data
        ->get();
        $data['topa'] = DB::table('detail_barang_keluars')
        ->join('barangs', 'detail_barang_keluars.barang_id', '=', 'barangs.barang_id')
        ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
        ->selectRaw("count('detail_barang_keluars.barang_id') as total, barangs.nama_barang, kategoris.jenis_barang")
        ->where('kategoris.jenis_barang', '2')
        ->groupBy('detail_barang_keluars.barang_id', 'barangs.nama_barang', 'kategoris.jenis_barang')
        ->orderBy('total', 'desc')
        ->take(5) //memberikan limit 5 baris data
        ->get();
        // $barang_keluars = DB::table('detail_barang_keluars')->select('created_at')->orderBy('created_at')->get();
        $consumables = Barang::select('barangs.barang_id')
                        ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
                        ->where('kategoris.jenis_barang', 1)->get();
        $assets = Barang::select('barangs.barang_id')
        ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
        ->where('kategoris.jenis_barang', 2)->get();
    $bulan_consumables = DetailBarangKeluar::whereIn('barang_id', $consumables)->pluck('created_at')->map(function($created_at){
        return Carbon::parse($created_at)->format('m');
    })->unique()->sort();
    $bulan_assets = DetailBarangKeluar::whereIn('barang_id', $assets)->pluck('created_at')->map(function($created_at){
        return Carbon::parse($created_at)->format('m');
    })->unique()->sort();
    $bulan = $bulan_consumables->merge($bulan_assets)->unique()->sort();
        $stringmonth = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $data['month'] = [];
        $count = 0;
        foreach ($bulan as $key => $value) {
            $data['month'][$count]['month'] = $stringmonth[$value];
            $data['month'][$count]['consumables'] = DetailBarangKeluar::whereIn('barang_id', $consumables)->whereMonth('created_at', $value)->sum('jumlah_barang_keluar');
            $data['month'][$count]['assets'] = DetailBarangKeluar::whereIn('barang_id', $assets)->whereMonth('created_at', $value)->sum('jumlah_barang_keluar');
            $count++;
        }
        // return dd($data['topa']);
        return view('dashboard', $data);

    }

}
