<?php

namespace App\Http\Controllers;

use App\Models\DetailBarangMasuk;
use App\Models\Menu;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;


class DetailBarangMasukController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('DetailBarangMasuk', $data);
    }

    public function datatables()
    {
        $data = DetailBarangMasuk::orderBy('barang_masuk_id', 'asc')->where('delete_mark', 0)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->detail_barang_masuk_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->detail_barang_masuk_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $attributes = $request->only([
        
        'detail_barang_masuk_code',
        'barang_masuk_code',
        'barang_code',
        'jumlah_barang_masuk',
        'delete_mark',
       ]);
        $roles = [
            'detail_barang_masuk_code' => 'required | unique:detail_barang_masuks,detail_barang_masuk_id',
            'barang_masuk_code' => 'required | exists:barang_masuks,barang_masuk_id',
            'barang_code' => 'required | exists:barangs,barang_id',
            'jumlah_barang_masuk' => 'required',
            'delete_mark' => 'required',

        ];

        
        
        $messages = [
            'required' => trans('messages.required'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {        
            $data = DetailBarangMasuk::create([
                'detail_barang_masuk_id' => $request->detail_barang_masuk_code,
                'barang_masuk_id' => $request->barang_masuk_code,
                'barang_id' => $request->barang_code,
                'jumlah_barang_masuk' => $request->jumlah_barang_masuk,
                'delete_mark' => $request->delete_mark,
            ]);
            
            $data = DB::table('DetailBarangMasuk')->insert([
                'detail_barang_masuk_id' => $request->detail_barang_masuk_code,
                'barang_masuk_id' => $request->barang_masuk_code,
                'barang_id' => $request->barang_code,
                'jumlah_barang_masuk' => $request->jumlah_barang_masuk,
                'delete_mark' => $request->delete_mark,
            ]);
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
        $attributes['detail_barang_masuk_id'] = $id;

        $roles = [
            'detail_barang_masuk_id' => 'required | exists:detail_barang_masuks,detail_barang_masuk_id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(DetailBarangMasuk::class, ['detail_barang_masuk_id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function edit($id)
    {
        $query   = DetailBarangMasuk::find($id);
        $response = responseSuccess(trans("messages.read-success"), $query);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        //
    }
    
    public function update($id, Request $request)
    {

        $attributes = $request->only([
        'detail_barang_masuk_code',
        'barang_masuk_code',
        'barang_code',
        'jumlah_barang_masuk',
        'delete_mark',


        ]);  
       
        

        $roles = [
            'detail_barang_masuk_code' => 'required | exists:detail_barang_masuks,detail_barang_masuk_id',
            'barang_masuk_code' => 'required | exists:barang_masuks,barang_masuk_id',
            'barang_code' => 'required | exists:barangs,barang_id',
            'jumlah_barang_masuk' => 'required',
            'delete_mark' => 'required',

        ];

        $messages = [   
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(DetailBarangMasuk::class, ['detail_barang_masuk_id' => $id]);

        DB::beginTransaction();
        try {
        $data->update([ 
           
            'detail_barang_masuk_id' => $request->detail_barang_masuk_code,
            'barang_masuk_id' => $request->barang_masuk_code,
            'barang_id' => $request->barang_code,
            'jumlah_barang_masuk' => $request->jumlah_barang_masuk,
            'delete_mark' => $request->delete_mark,
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

        DetailBarangMasuk::destroy($id);
        $response = responseSuccess(trans('message.delete-success'));
        return response()->json($response,200);
    }
}
