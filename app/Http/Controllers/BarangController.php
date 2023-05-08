<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Menu;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('Barang', $data);
    }

    public function datatables()
    {
        $data = Barang::orderBy('nama_barang', 'asc')->where('delete_mark', 0)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->barang_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->barang_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $attributes = $request->only([
            'barang_name',
            'jenis_code',
            'jumlah_code',
            'keterangan_code',            
        ]);
        $roles = [
            'barang_name' => 'required',
            'jenis_code' => 'required',
            'jumlah_code' => 'required',
            'keterangan_code' => 'required',

        ];
        $messages = [
            'required' => trans('messages.required'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {        
            $data = Barang::create([
                'user_id' => Auth::user()->id,
                'nama_barang' => $request->barang_name,
                'jenis_barang' => $request->jenis_code,
                'jumlah_barang' => (int)$request->jumlah_code,
                'keterangan_barang' => $request->keterangan_code,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // $data = DB::table('barangs')->insert([
            //     'user_id' => $request->user_code,
            //     'nama_barang' => $request->barang_name,
            //     'jenis_barang' => $request->jenis_code,
            //     'jumlah_barang' => (int)$request->jumlah_code,
            //     'keterangan_barang' => $request->keterangan_code,
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
        $attributes['barang_id'] = $id;

        $roles = [
            'barang_id' => 'required|exists:barangs,barang_id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(Barang::class, ['barang_id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        return $id;
    }

    public function edit($id)
    {
        $query   = Barang::find($id);
        $response = responseSuccess(trans("messages.read-success"), $query);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        //
    }
    
    public function update($id, Request $request)
    {

        $attributes = $request->only([
            'user_code',
            'barang_name',
            'jenis_code',
            'jumlah_code',
            'keterangan_code',
       
        ]);

        $roles = [
            'user_code' => 'required | exists:users,id',
            'barang_name' => 'required',
            'jenis_code' => 'required',
            'jumlah_code' => 'required',
            'keterangan_code' => 'required',
        
        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(Barang::class, ['barang_id' => $id]);

        DB::beginTransaction();
        try {
        $data->update([ 
            'nama_barang' => $request->barang_name,
            'user_id' => $request->user_code,
            'jenis_barang' => $request->jenis_code,                 
            'keterangan_barang' => $request->keterangan_code,
            'jumlah_barang' => $request->jumlah_code,
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

        Barang::destroy($id);
        $response = responseSuccess(trans('message.delete-success'));
        return response()->json($response,200);
    }
}
