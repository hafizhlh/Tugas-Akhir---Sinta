<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Company;
use App\Models\Interco;
use App\Models\IntercoPeriode;
use DB;
use Illuminate\Http\Request;

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
        ->selectRaw( 'count(*) as total')->groupBy('jenis_barang')->orderBy('total', 'asc')
        ->get();
        $data['topc'] = DB::table('detail_barang_keluars')
        ->join('barangs', 'detail_barang_keluars.barang_id', '=', 'barangs.barang_id')
        ->selectRaw("count('detail_barang_keluars.barang_id') as total, barangs.nama_barang, barangs.jenis_barang")
        ->where('barangs.jenis_barang', '1')
        ->groupBy('detail_barang_keluars.barang_id', 'barangs.nama_barang', 'barangs.jenis_barang')
        ->orderBy('total', 'desc')
        ->get();
        $data['topa'] = DB::table('detail_barang_keluars')
        ->join('barangs', 'detail_barang_keluars.barang_id', '=', 'barangs.barang_id')
        ->selectRaw("count('detail_barang_keluars.barang_id') as total, barangs.nama_barang, barangs.jenis_barang")
        ->where('barangs.jenis_barang', '2')
        ->groupBy('detail_barang_keluars.barang_id', 'barangs.nama_barang', 'barangs.jenis_barang')
        ->orderBy('total', 'desc')
        ->get();
        // return dd($data['topa']);
        return view('dashboard', $data);

    }

}
