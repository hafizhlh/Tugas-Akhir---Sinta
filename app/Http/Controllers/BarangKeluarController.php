<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

use App\Models\BarangKeluar;
use App\Models\DetailBarangKeluar;
use App\Models\Menu;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        $data['barang']= Barang::select('barang_id', 'nama_barang')->get();
        return view('BarangKeluar', $data);
    }

    public function datatables()
    {
        $data = DB::table('barang_keluars')
                ->join('detail_barang_keluars', 'barang_keluars.barang_keluar_id', '=', 'detail_barang_keluars.barang_keluar_id')
                ->join('barangs', 'detail_barang_keluars.barang_id', '=', 'barangs.barang_id')
                ->where('barang_keluars.delete_mark', 0)
                ->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->barang_keluar_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->barang_keluar_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->barang_keluar_id . '" data-original-title="return" class="return btn btn-info btn-sm returnBarang">Return Barang</a>';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $barang = Barang::where('barang_id', $request->barang_code)->first();
        if($barang->jumlah_barang < $request->jumlah){
            return response()->json([
                'status' => 'error',
                'message' => 'Jumlah barang tidak mencukupi',
            ]);
        }

        $attributes = $request->only([
            'nodofetiket_code',
            'keterangan_code',   
            'barang_code',
            'jumlah',        
        ]);
        $roles = [
            'nodofetiket_code' => 'required',
            'keterangan_code' => 'required',
            'barang_code' => 'required',
            'jumlah' => 'required',
        ];
        $messages = [
            'required' => trans('messages.required'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {        
            $data = DB::table('barang_keluars')->insert([
                'user_id' => Auth::user()->id,
                'no_dof_etiket' => $request->nodofetiket_code,
                'tgl_pengambilan' => date('Y-m-d'),
                'keterangan' => $request->keterangan_code,
                'delete_mark' => 0,
            ]);
            if($data){
                $barang_keluar_id = DB::getPdo()->lastInsertId();
                $data = DB::table('detail_barang_keluars')->insert([
                    'barang_keluar_id' => $barang_keluar_id,
                    'barang_id' => $request->barang_code,
                    'jumlah_barang_keluar' => $request->jumlah,
                    'delete_mark' => 0,
                ]);
                $data = DB::table('barangs')->where('barang_id', $request->barang_code)->update([
                    'jumlah_barang' => $barang->jumlah_barang - $request->jumlah,
                ]);
                
                $data=array([
                    'barang_keluar_id' => $barang_keluar_id,
                    'barang_id' => $request->barang_code,
                    'jumlah_barang_keluar' => $request->jumlah,
                    'delete_mark' => 0,
                ]);
            }
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
        $attributes['barang_keluar_id'] = $id;

        $roles = [
            'barang_keluar_id' => 'required|exists:barang_keluars,barang_keluar_id',

        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(BarangKeluar::class, ['barang_keluar_id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function edit($id)
    {
        $query   = BarangKeluar::find($id);
        $response = responseSuccess(trans("messages.read-success"), $query);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        //
    }
    
    public function update($id, Request $request)
    {

        $attributes = $request->only([
            'user_code',
            'tanggal',
            'nodofticket',
            'keterangan_code',  
       
        ]);

        $roles = [
            'user_code' => 'required | exists:users,id',
            'tanggal' => 'required',
            'nodofticket' => 'required',
            'keterangan_code' => 'required',            
        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(BarangKeluar::class, ['barang_keluar_id' => $id]);

        DB::beginTransaction();
        try {
        $data->update([ 
           
            'user_id' => $request->user_code,
            'tgl_pengambilan' => $request->tanggal,
            'no_dof_etiket' => $request->nodofetiket_code,
            'keterangan' => $request->keterangan_code,       
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

        BarangKeluar::destroy($id);
        $response = responseSuccess(trans('message.delete-success'));
        return response()->json($response,200);
    }

    public function getBarang($jenis_code){
        $data = Barang::where('jenis_barang', $jenis_code)->get();
        return response()->json($data);
    }
}
