<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\StokBarang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokBarangController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('StokBarang', $data);
    }

    public function datatables()
    {
        $data = StokBarang::orderBy('tanggal', 'asc')->where('delete_mark', 0)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->stok_barang_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->stok_barang_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $attributes = $request->only([
            'stok_barang_code',
            'barang_code',
            'masuks',
            'keluars',
            'transaksi_code',
            'jenis_barang_code',
            'tanggal',
            'saldo',
            'delete_mark',

        ]);
        $roles = [
            'stok_barang_code' => 'required | exists:stok_barang,stok_barang_id',
            'barang_code' => 'required | exists:barang,barang_id',
            'masuks' => 'required',
            'keluars' => 'required',
            'transaksi_code' => 'required ',
            'jenis_barang_code' => 'required',
            'tanggal' => 'required',
            'saldo' => 'required',
            'delete_mark' => 'required',


        ];
        $messages = [
            'required' => trans('messages.required'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {        
            $data = StokBarang::create([
                'stok_barang_id' => $request->stok_barang_code,
                'barang_id' => $request->barang_code,
                'masuk' => $request->masuks,
                'keluar' => $request->keluars,
                'transaksi_id' => $request->transaksi_code,
                'jenis_barang_id' => $request->jenis_barang_code,
                'tanggal' => $request->tanggal,
                'saldo' => $request->saldo,
                'delete_mark' => $request->delete_mark,            
                'updated_at' => now(),
            ]);
            
            // $data = DB::table('stokbarang')->insert([
            //     'stok_barang_id' => $request->stok_barang_code,
            //     'barang_id' => $request->barang_code,
            //     'masuk' => $request->masuks,
            //     'keluar' => $request->keluars,
            //     'transaksi_id' => $request->transaksi_code,
            //     'jenis_barang_id' => $request->jenis_barang_code,
            //     'tanggal' => $request->tanggal,
            //     'saldo' => $request->saldo,
            //     'delete_mark' => $request->delete_mark,            
            //     'updated_at' => now(),
            // ]);
            DB::commit();
            $response = responseSuccess(trans("messages.create-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            $response = responseFail(trans("messages.create-fail"), $th->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function show($id)
    {
        $attributes['stok_barang_id'] = $id;

        $roles = [
            'stok_barang_id' => 'required|exists:stok_barangs,stok_barang_id',

        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(StokBarang::class, ['stok_barang_id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function edit($id)
    {
        $query   = StokBarang::find($id);
        $response = responseSuccess(trans("messages.read-success"), $query);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        //
    }
    
    public function update($id, Request $request)
    {

        $attributes = $request->only([
            'stok_barang_code',
            'barang_code',
            'masuks',
            'keluars',
            'transaksi_code',
            'jenis_barang_code',
            'tanggal',
            'saldo',
            'delete_mark',

        ]);  
       
        

        $roles = [
            'stok_barang_code' => 'required | exists:stok_barang,stok_barang_id',
            'barang_code' => 'required | exists:barang,barang_id',
            'masuks' => 'required',
            'keluars' => 'required',
            'transaksi_code' => 'required ',
            'jenis_barang_code' => 'required',
            'tanggal' => 'required',
            'saldo' => 'required',
            'delete_mark' => 'required',

        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(StokBarang::class, ['stok_barang_id' => $id]);

        DB::beginTransaction();
        try {
        $data->update([ 
           
            'stok_barang_id' => $request->stok_barang_code,
            'barang_id' => $request->barang_code,
            'masuk' => $request->masuks,
            'keluar' => $request->keluars,
            'transaksi_id' => $request->transaksi_code,
            'jenis_barang_id' => $request->jenis_barang_code,
            'tanggal' => $request->tanggal,
            'saldo' => $request->saldo,
            'delete_mark' => $request->delete_mark,            
            'updated_at' => now(),
        ]);
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

        StokBarang::destroy($id);
        $response = responseSuccess(trans('message.delete-success'));
        return response()->json($response,200);
    }
}
