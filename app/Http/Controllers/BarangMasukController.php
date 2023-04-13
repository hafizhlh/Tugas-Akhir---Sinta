<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\Menu;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BarangMasukController extends Controller
{




    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('BarangMasuk', $data);
    }
    

    public function datatables()
    {
        $data = BarangMasuk::orderBy('tanggal_barang_masuk', 'asc')->where('delete_mark', 0)
        ->join('detail_barang_masuks', 'detail_barang_masuks.barang_masuk_id', '=', 'barang_masuks.barang_masuk_id')
        ->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->barang_masuk_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->barang_masuk_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $attributes = $request->only([
            'barang_masuk_code',
            'tanggal_barang_masuk',
            'delete_mark',
        ]);
        $roles = [
            'barang_masuk_code' => 'required',
            'tanggal_barang_masuk' => 'required',
            'delete_mark' => 'required',
        ];  

        
        $messages = [
            'required' => trans('messages.required'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {        
            $data = BarangMasuk::create([
                'barang_masuk_id' => $request->barang_masuk_code,
                'tanggal_barang_masuk' => $request->tanggal_barang_masuk,
                'delete_mark' => $request->delete_mark,
            ]);
            
            $data = DB::table('barangmasuk')->insert([
            
                'barang_masuk_id' => $request->barang_masuk_code,
                'tanggal_barang_masuk' => $request->tanggal_barang_masuk,
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
        $attributes['barang_masuk_id'] = $id;

        $roles = [
            'barang_masuk_id' => 'required | exists:barang_masuks,barang_masuk_id',
        ];
        
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(BarangMasuk::class, ['barang_masuk_id' => $id]);
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
            'barang_masuk_code',
            'tanggal_barang_masuk',
            'delete_mark',
        ]);
       
        

        $roles = [
            'barang_masuk_code' => 'required',
            'tanggal_barang_masuk' => 'required',
            'delete_mark' => 'required',
        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(BarangMasuk::class, ['barang_masuk_id' => $id]);

        DB::beginTransaction();
        try {
        $data->update([ 
           
            'barang_masuk_id' => $request->barang_masuk_code,
            'tanggal_barang_masuk' => $request->tanggal_barang_masuk,
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

        BarangMasuk::destroy($id);
        $response = responseSuccess(trans('message.delete-success'));
        return response()->json($response,200);
    }
}
