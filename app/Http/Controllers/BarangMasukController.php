<?php

namespace App\Http\Controllers;

use App\Exports\BarangAssetsSheet;
use App\Exports\BarangConsummableSheet;
use App\Exports\BarangmasukExport;
use App\Exports\ExportMultipleSheets;
use App\Exports\Exportxls;
use App\Imports\BarangmasukImport;
use App\Models\DetailBarangMasuk;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BarangMasukController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        $data['barang'] = Barang::select('barang_id', 'nama_barang')->get();
        $data['kategori'] = DB::table('kategoris')->get();
        return view('barangmasuk', $data);

        // Menambahkan parameter jenis_barang pada query untuk menyortir berdasarkan jenis barang yang dipilih
    if (isset($_GET['jenis_barang'])) {
        $jenisBarang = $_GET['jenis_barang'];
        $data['barang'] = Barang::select('barang_id', 'nama_barang')->where('jenis_barang', $jenisBarang)->get();
    }
    
    return view('BarangMasuk', $data);
    }


    public function datatables()
    {
        $data = DB::table('detail_barang_masuks')
            ->join('barang_masuks', 'detail_barang_masuks.barang_masuk_id', '=', 'barang_masuks.barang_masuk_id')
            ->join('barangs', 'detail_barang_masuks.barang_id', '=', 'barangs.barang_id')
            ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->select('barang_masuks.barang_masuk_id as id_barang_masuk', 'barang_masuks.*', 'detail_barang_masuks.*', 'barangs.*', 'kategoris.*')
            ->where('barang_masuks.delete_mark', 0)
            ->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('jenis_barang', function ($row) {
                $jenis = $row->jenis_barang;
                if ($jenis == 1) {
                    $jenis = 'Consumable';
                } else if ($jenis == 2) {
                    $jenis = 'Aset';
                }
                return $jenis;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id_barang_masuk . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id_barang_masuk . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id_barang_masuk . '" data-tanggal_barang_masuk="' . $row->tanggal_barang_masuk . '"data-nama_barang="' . $row->nama_barang . '"data-jenis_barang="' . $row->jenis_barang . '"data-jumlah_barang_masuk="' . $row->jumlah_barang_masuk . '" data-jumlah_barang="' . $row->jumlah_barang . '"data-keterangan_barang="' . $row->keterangan_barang . '" data-nama_kategori="'.$row->nama_kategori.'" data-original-title="Detail" class="btn btn-info btn-sm detailBarang">Detail</a>';
                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $barang = DB::table('barangs')->where('barang_id', $request->barang_code)->first();
        $attributes = $request->only([
            'barang_code',
            'jumlah',
        ]);
        $roles = [

            'barang_code' => 'required',
            'jumlah' => 'required',
        ];


        $messages = [
            'required' => trans('messages.required'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {
            // $data = DB::table('barang_masuks')->insert([

            //     'tanggal_barang_masuk' =>date('Y-m-d'),

            // ]);

            //         $id=$data->id;
            //      $data = DB::table('detail_barang_masuks')->insert([                    
            //          'barang_id' => $request->barang_code,
            //          'jumlah_barang_masuk' => $request->jumlah,
            //          'delete_mark' => 0,
            //      ]);
            //      //$data barangs include jumlah


            //         $data = DB::table('barangs')->where('barang_id', $request->barang_code)->update([
            //             'jumlah_barang' => $barang->jumlah_barang + $request->jumlah,

            //      ]);

            //      $data=array([

            //          'barang_id' => $request->barang_code,
            //          'jumlah_barang_masuk' => $request->jumlah,
            //          'delete_mark' => 0,

            //         ]);
            //     }


            // DB::commit();
            $barang_masuk = BarangMasuk::create([
                'tanggal_barang_masuk' => date('Y-m-d'),
                'delete_mark' => 0,
            ]);
            DetailBarangMasuk::create([
                'barang_masuk_id' => $barang_masuk->barang_masuk_id,
                'barang_id' => $request->barang_code,
                'jumlah_barang_masuk' => $request->jumlah,
                'delete_mark' => 0,
            ]);
            DB::table('barangs')->where('barang_id', $request->barang_code)->update([
                'jumlah_barang' => $barang->jumlah_barang + $request->jumlah,
            ]);
            DB::commit();
            $response = responseSuccess(trans("messages.create-success"));
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            $response = responseFail(trans("messages.create-fail"), $th->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function show($id)
    {
        // dd($id);
        $attributes['barang_masuk_id'] = $id;

        $roles = [
            'barang_masuk_id' => 'required | exists:barang_masuks,barang_masuk_id',
        ];

        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = BarangMasuk::join('detail_barang_masuks', 'barang_masuks.barang_masuk_id', '=', 'detail_barang_masuks.barang_masuk_id')
            ->join('barangs', 'detail_barang_masuks.barang_id', '=', 'barangs.barang_id')
            ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->where('barang_masuks.barang_masuk_id', $id)
            ->get();
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function edit($id)
    {
        $query   = BarangMasuk::find($id);
        $response = responseSuccess(trans("messages.read-success"), $query);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        //
    }

    public function update($id, Request $request)
    {
        $attributes = $request->only([
            'jumlah',
        ]);



        $roles = [
            'jumlah' => 'required',

        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {
            $detailbarangmasuk = DetailBarangMasuk::where('barang_masuk_id', $id)->first();
            $barang = DB::table('barangs')->where('barang_id', $detailbarangmasuk->barang_id)->first();
            $data_old = DB::table('detail_barang_masuks')->where('barang_masuk_id', $id)->first();
            $data = DB::table('detail_barang_masuks')->where('barang_masuk_id', $id)->update([
                'jumlah_barang_masuk' => $request->jumlah,
                'delete_mark' => 0,
            ]);
            $data = DB::table('barangs')->where('barang_id', $detailbarangmasuk->barang_id)->update([
                'jumlah_barang' => $barang->jumlah_barang + ($request->jumlah - $data_old->jumlah_barang_masuk),
            ]);
            $data = [
                'barang_masuk_id' => $id,
                'jumlah_barang_masuk' => $request->jumlah,
                'delete_mark' => 0,
            ];
            DB::commit();
            $response = responseSuccess(trans("messages.update-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response = responseFail(trans("messages.update-fail"), $e->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }
    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            // min stock barang from table barang
            $data = DB::table('detail_barang_masuks')->where('barang_masuk_id', $id)->first();
            $barang = DB::table('barangs')->where('barang_id', $data->barang_id)->first();
            $data = DB::table('barangs')->where('barang_id', $data->barang_id)->update([
                'jumlah_barang' => $barang->jumlah_barang - $data->jumlah_barang_masuk,
            ]);
            DB::table('barang_masuks')->where('barang_masuk_id', $id)->update([
                'delete_mark' => 1,
            ]);
            $response = responseSuccess(trans('message.delete-success'));
            DB::commit();
            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }
    
    public function getBarang($jenis_code)
    {
        $data = Barang::where('jenis_barang', $jenis_code)->get();
        return response()->json($data);
    }

    public function export()
    {
        // $data = DB::select('SELECT * FROM Barang_masuks'); // Ganti dengan query yang sesuai

        // return Excel::download(new ($data), 'barangmasuk.xlsx'); // Ganti dengan nama export file yang diinginkan
        return (new BarangmasukExport(date('m'), date('Y')))->download('barangmasuk.xlsx');
    }
    public function getCountByBarangMasukId($barang_masuk_id)
    {
        $count = DB::table('detail_barang_masuks')
            ->where('barang_masuk_id', $barang_masuk_id)
            ->count();
        return $count;
    }
    public function exportTanggalBarangMasuk(Request $request)
    {
        $data = DB::table('detail_barang_masuks')
        ->join('barang_masuks', 'detail_barang_masuks.barang_masuk_id', '=', 'barang_masuks.barang_masuk_id')
        ->join('barangs', 'detail_barang_masuks.barang_id', '=', 'barangs.barang_id')
        ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
        ->whereBetween('barang_masuks.tanggal_barang_masuk', [$request->tanggal_awal, $request->tanggal_akhir])

        ->select('barang_masuks.tanggal_barang_masuk', 'barangs.nama_barang', 'kategoris.jenis_barang', 'kategoris.nama_kategori', 'detail_barang_masuks.jumlah_barang_masuk', 'barangs.jumlah_barang', 'barangs.keterangan_barang')
        ->get();
    
        
    
        $collect = $data->map(function ($item) {
            $item->jenis_barang = $item->jenis_barang == 1 ? "consummable" : "asset";
            return $item;
        });
    
        $column = [
            'Tanggal Barang Masuk',           
             'Nama Barang',          
             'Jenis Barang',
             'Kategori Barang',
             'Jumlah Barang Masuk',
             'Jumlah Stok barang saat ini',
             'Keterangan barang'
 
         ];
    
        return Excel::download((new Exportxls($data, $column)), 'Laporan BarangMasuk bulanan.xlsx');
    }
    
    public function exportTahunBarangMasuk():BinaryFileResponse
    {
        $year_now = date('Y');
        $data = DB::table('detail_barang_masuks')
            ->join('barang_masuks', 'detail_barang_masuks.barang_masuk_id', '=', 'barang_masuks.barang_masuk_id')
            ->join('barangs', 'detail_barang_masuks.barang_id', '=', 'barangs.barang_id')
            ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')

            
            // ->select('barang_masuks.barang_masuk_id as id_barang_masuk', 'barang_masuks.*', 'detail_barang_masuks.*', 'barangs.*')
            ->where('tanggal_barang_masuk', 'like','%'.$year_now .'%')          
            ->select("barang_masuks.tanggal_barang_masuk","barangs.nama_barang", "kategoris.jenis_barang","kategoris.nama_kategori","detail_barang_masuks.jumlah_barang_masuk","barangs.jumlah_barang","barangs.keterangan_barang")
            ->get();

        $collect = $data->map(function ($item) {
            $item->jenis_barang = $item->jenis_barang == 1 ? "consummable" : "asset";
            return $item;
        });

        
        $consummableData = $data->filter(function ($item) {
            return $item->jenis_barang == "consummable";
        });
        
        $assetData = $data->filter(function ($item) {
            return $item->jenis_barang == "asset";
        });
        
    $sheets = [
        new BarangConsummableSheet($consummableData),
        new BarangAssetsSheet($assetData),
    ];
        // dd($collect);
        

        $column = [
            'Tanggal Barang Masuk',           
             'Nama Barang',          
             'Jenis Barang',
             'Kategori Barang',
             'Jumlah Barang Masuk',
             'Jumlah Stok barang saat ini',
             'Keterangan barang'
 
         ];
         return Excel::download(new ExportMultipleSheets($sheets), 'Laporan BarangMasuk tahunan.xlsx');
    }
    public function import()
    {
        Excel::import(new BarangmasukImport, request()->file('file'));
        return back();
    }
}
