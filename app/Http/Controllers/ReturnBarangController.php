<?php

namespace App\Http\Controllers;

use App\Models\DetailReturnBarang;
use App\Models\Menu;
use App\Models\Barang;
use App\Models\ReturnBarang;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnBarangController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        $data['barang']= Barang::select('barang_id', 'nama_barang')->get();
        return view('ReturnBarang', $data);
    }

    public function datatables()
    {
        $data = DB::table('return_barangs')
                ->join('detail_return_barangs', 'return_barangs.return_id', '=', 'detail_return_barangs.return_id')
                // ->join('detail_barang_keluars', 'barang_keluars.barang_keluar_id', '=', 'detail_barang_keluars.barang_keluar_id')
                ->join('barangs', 'detail_return_barangs.barang_id', '=', 'barangs.barang_id')
                ->where('return_barangs.delete_mark', 0);
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->return_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->return_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        // return dd($request->all());
        DB::beginTransaction();
        try {
            $barang_keluar = DB::table('barang_keluars')->where('barang_keluar_id', $request->barang_keluar_id)->first();        
            $return_barang = DB::table('return_barangs')->insert([
                'user_id' => Auth::user()->id,
                'barang_keluar_id' => $request->barang_keluar_id,
                'waktu_return' => date('Y-m-d'),
                'delete_mark' => 0,
            ]);
            $return_id = DB::getPdo()->lastInsertId();
            $detail_return = DB::table('detail_return_barangs')->insert([
                'return_id' => $return_id,
                'barang_id' => $request->barang_id,
                'jumlah_barang_return' => $request->jumlah,
                'delete_mark' => 0,
            ]);
            $barang_keluar = DB::table('detail_barang_keluars')->where('barang_keluar_id', $request->barang_keluar_id)->where('barang_id', $request->barang_id)->first();
            if($barang_keluar->jumlah_barang_keluar < $request->jumlah){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jumlah barang yang dikembalikan melebihi jumlah barang yang dikeluarkan',
                ], 500);
            }
            $jumlah_barang_keluar = $barang_keluar->jumlah_barang_keluar - $request->jumlah;
            $update_jumlah = DB::table('detail_barang_keluars')->where('barang_keluar_id', $request->barang_keluar_id)->where('barang_id', $request->barang_id)->update([
                'jumlah_barang_keluar' => $jumlah_barang_keluar,
            ]);

            $barang = DB::table('barangs')->where('barang_id', $request->barang_id)->first();
            //update jumlah barang
            $jumlah = $barang->jumlah_barang + $request->jumlah;
            $update_jumlah = DB::table('barangs')->where('barang_id', $request->barang_id)->update([
                'jumlah_barang' => $jumlah,
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
        $data = DB::table('barang_keluars')
                ->join('detail_barang_keluars', 'barang_keluars.barang_keluar_id', '=', 'detail_barang_keluars.barang_keluar_id')
                ->join('barangs', 'detail_barang_keluars.barang_id', '=', 'barangs.barang_id')
                ->where('barang_keluars.barang_keluar_id', $id)
                ->get();
        // change jenis_barang to nama_barang
        foreach ($data as $key => $value) {
            if($data[$key]->jenis_barang == 1){
                $data[$key]->jenis_barang = 'Consumable';
            }
            else if($data[$key]->jenis_barang == 2){
                $data[$key]->jenis_barang = 'Asset';
            }
        }
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function edit($id)
    {
        $query   = ReturnBarang::find($id);
        $response = responseSuccess(trans("messages.read-success"), $query);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        //
    }
    
    public function update($id, Request $request)
    {

        $attributes = $request->only([
            'return_code',
            'user_code',
            'barang_keluar_code',
            'waktu_return',
            'delete_mark',

        ]);  
       
        

        $roles = [
            'return_code' => 'required | exists:return_barang,return_id',
            'user_code' => 'required | exists:user,user_id',
            'barang_keluar_code' => 'required | exists:barang_keluar,barang_keluar_id',
            'waktu_return' => 'required',
            'delete_mark' => 'required',

        ];

        $messages = [   
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(ReturnBarang::class, ['return_id' => $id]);

        DB::beginTransaction();
        try {
        $data->update([ 
           
            'return_id' => $request->return_code,
            'user_id' => $request->user_code,
            'barang_keluar_id' => $request->barang_keluar_code,
            'waktu_return' => $request->waktu_return,
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

        ReturnBarang::destroy($id);
        $response = responseSuccess(trans('message.delete-success'));
        return response()->json($response,200);
    }
    public function getBarang($jenis_code){
        $data = Barang::where('jenis_barang', $jenis_code)->get();
        return response()->json($data);
    }
}
