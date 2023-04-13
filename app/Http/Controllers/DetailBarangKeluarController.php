<?php

namespace App\Http\Controllers;

use App\Models\DetailBarangKeluar;
use App\Models\Menu;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class DetailBarangKeluarController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('DetailBarangKeluar', $data);
    }

    public function datatables()
    {
        $data = DetailBarangKeluar::orderBy('barang_keluar_id', 'asc')->where('delete_mark', 0)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->detail_barang_keluar_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->detail_barang_keluar_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $attributes = $request->only([
            'detail_barang_keluar_code',
            'barang_keluar_code',
            'barang_code',  
            'jumlah',
            'delete_mark',


        ]);
        $roles = [
            'detail_barang_keluar_code' => 'required | exists:detail_barang_keluars,detail_barang_keluar_id',
            'barang_keluar_code' => 'required | exists:barang_keluar,barang_keluar_id',
            'barang_code' => 'required | exists:barang,barang_id',
            'jumlah' => 'required',
            'delete_mark' => 'required',

        ];


       
        $messages = [
            'required' => trans('messages.required'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {        
            $data = DetailBarangKeluar::create([
                'barang_keluar_id' => $request->barang_keluar_code,
                'barang_id' => $request->barang_code,
                'jumlah' => $request->jumlah,
                'delete_mark' => $request->delete_mark,            
                'updated_at' => now(),
            ]);
        
            $data = DB::table('DetailBarangKeluar')->insert([
                'barang_keluar_id' => $request->barang_keluar_code,
                'barang_id' => $request->barang_code,
                'jumlah' => $request->jumlah,
                'delete_mark' => $request->delete_mark,            
                'updated_at' => now(),
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
        $attributes['detail_barang_keluar_id'] = $id;

        $roles = [
            'detail_barang_keluar_id' => 'required | exists:detail_barang_keluar,detail_barang_keluar_id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(DetailBarangKeluar::class, ['detail_barang_keluar_id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function edit($id)
    {
        $query   = DetailBarangKeluar::find($id);
        $response = responseSuccess(trans("messages.read-success"), $query);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        //
    }
    
    public function update($id, Request $request)
    {

        $attributes = $request->only([
          'detail_barang_keluar_code',
            'barang_keluar_code',
            'barang_code',  
            'jumlah',
            'delete_mark',

        ]);  
       
        

        $roles = [
            'detail_barang_keluar_code' => 'required | exists:detail_barang_keluar,detail_barang_keluar_id',
            'barang_keluar_code' => 'required | exists:barang_keluar,barang_keluar_id',
            'barang_code' => 'required | exists:barang,barang_id',
            'jumlah' => 'required',
            'delete_mark' => 'required',

        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(DetailBarangKeluar::class, ['detail_barang_keluar_id' => $id]);

        DB::beginTransaction();
        try {
        $data->update([ 
           
            'detail_barang_keluar_id' => $request->detail_barang_keluar_code,
            'barang_keluar_id' => $request->barang_keluar_code,
            'barang_id' => $request->barang_code,
            'jumlah' => $request->jumlah,
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

        DetailBarangKeluar::destroy($id);
        $response = responseSuccess(trans('message.delete-success'));
        return response()->json($response,200);
    }
}
