<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Company;
use App\Models\DetailBarangKeluar;
use App\Models\Interco;
use App\Models\IntercoPeriode;
use App\Models\ReturnBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['menus'] = $this->getDashboardMenu();
        
        // PERBAIKAN 1: Query pie chart - tambahkan field jenis_barang untuk grouping
        $data['pie'] = DB::table('barangs')
            ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->selectRaw('count(*) as total, kategoris.jenis_barang')
            ->groupBy('kategoris.jenis_barang')
            ->orderBy('kategoris.jenis_barang', 'asc')
            ->get();

        // Debug: pastikan ada data
        if ($data['pie']->isEmpty()) {
            // Jika tidak ada data, buat dummy data agar chart tidak error
            $data['pie'] = collect([
                (object)['total' => 0, 'jenis_barang' => '1'],
                (object)['total' => 0, 'jenis_barang' => '2']
            ]);
        }

        // PERBAIKAN 2: Query top consumable - perbaiki sintaks COUNT
        $data['topc'] = DB::table('detail_barang_keluars')
            ->join('barangs', 'detail_barang_keluars.barang_id', '=', 'barangs.barang_id')
            ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->selectRaw("COUNT(detail_barang_keluars.barang_id) as total, barangs.nama_barang, kategoris.jenis_barang")
            ->where('kategoris.jenis_barang', '1')
            ->groupBy('detail_barang_keluars.barang_id', 'barangs.nama_barang', 'kategoris.jenis_barang')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // PERBAIKAN 3: Query top asset - perbaiki sintaks COUNT  
        $data['topa'] = DB::table('detail_barang_keluars')
            ->join('barangs', 'detail_barang_keluars.barang_id', '=', 'barangs.barang_id')
            ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->selectRaw("COUNT(detail_barang_keluars.barang_id) as total, barangs.nama_barang, kategoris.jenis_barang")
            ->where('kategoris.jenis_barang', '2')
            ->groupBy('detail_barang_keluars.barang_id', 'barangs.nama_barang', 'kategoris.jenis_barang')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // PERBAIKAN 4: Perbaiki logika untuk data bulanan
        $consumables = Barang::select('barangs.barang_id')
            ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->where('kategoris.jenis_barang', 1)
            ->pluck('barang_id'); // Gunakan pluck untuk mendapatkan array ID

        $assets = Barang::select('barangs.barang_id')
            ->join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->where('kategoris.jenis_barang', 2)
            ->pluck('barang_id'); // Gunakan pluck untuk mendapatkan array ID

        // PERBAIKAN 5: Gunakan tahun saat ini untuk filter data
        $currentYear = Carbon::now()->year;
        
        $bulan_consumables = DetailBarangKeluar::whereIn('barang_id', $consumables)
            ->whereYear('created_at', $currentYear)
            ->pluck('created_at')
            ->map(function($created_at) {
                return Carbon::parse($created_at)->format('m');
            })->unique()->sort();

        $bulan_assets = DetailBarangKeluar::whereIn('barang_id', $assets)
            ->whereYear('created_at', $currentYear)
            ->pluck('created_at')
            ->map(function($created_at) {
                return Carbon::parse($created_at)->format('m');
            })->unique()->sort();

        $bulan = $bulan_consumables->merge($bulan_assets)->unique()->sort();

        // PERBAIKAN 6: Jika tidak ada data bulan, gunakan bulan saat ini
        if ($bulan->isEmpty()) {
            $bulan = collect([Carbon::now()->format('m')]);
        }

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
            $data['month'][$count]['consumables'] = DetailBarangKeluar::whereIn('barang_id', $consumables)
                ->whereMonth('created_at', $value)
                ->whereYear('created_at', $currentYear)
                ->sum('jumlah_barang_keluar');
            $data['month'][$count]['assets'] = DetailBarangKeluar::whereIn('barang_id', $assets)
                ->whereMonth('created_at', $value)
                ->whereYear('created_at', $currentYear)
                ->sum('jumlah_barang_keluar');
            $count++;
        }
        
            $dataMasuk=BarangMasuk::count();
            $dataKeluar=BarangKeluar::count();
            $dataReturn=ReturnBarang::count();

            $data = array_merge($data, [
                'dataMasuk' => $dataMasuk,
                'dataKeluar' => $dataKeluar,
                'dataReturn' => $dataReturn,
            ]);
            
            return view('dashboard', $data);
        }
    }