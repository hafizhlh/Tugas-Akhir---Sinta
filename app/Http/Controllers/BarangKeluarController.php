<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\BarangKeluar;

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
        return view('BarangKeluar', $data);
    }

    public function datatables()
    {
        $data = BarangKeluar::orderBy('tgl_pengambilan', 'asc')->where('delete_mark', 0)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->barang_keluar_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->barang_keluar_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
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
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {        
            $data = BarangKeluar::create([
                'user_id' => $request->user_code,
                'tgl_pengambilan' => $request->tanggal,
                'no_dof_etiket' => $request->jenis_code,
                'keterangan' => $request->keterangan_code,             
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // $data = DB::table('barangkeluar')->insert([
            // 'user_id' => $request->user_code,
            // 'tgl_pengambilan' => $request->tanggal,
            // 'no_dof_etiket' => $request->jenis_code,
            // 'keterangan' => $request->keterangan_code, 
            //     'created_at' => now(),
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
            'no_dof_etiket' => $request->jenis_code,
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
}
