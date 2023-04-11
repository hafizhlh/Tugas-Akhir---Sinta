<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\ReturnBarang;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class ReturnBarangController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('ReturnBarang', $data);
    }

    public function datatables()
    {
        $data = ReturnBarang::orderBy('waktu_return', 'asc')->where('delete_mark', 0)->get();
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
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {        
            $data = ReturnBarang::create([
                'return_id' => $request->return_code,
                'user_id' => $request->user_code,
                'barang_keluar_id' => $request->barang_keluar_code,
                'waktu_return' => $request->waktu_return,
                'delete_mark' => $request->delete_mark,
            ]);
            
            // $data = DB::table('ReturnBarang')->insert([
            //     'return_id' => $request->return_code,
            //     'user_id' => $request->user_code,
            //     'barang_keluar_id' => $request->barang_keluar_code,
            //     'waktu_return' => $request->waktu_return,
            //     'delete_mark' => $request->delete_mark,
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
        $attributes['return_id'] = $id;

        $roles = [
            'return_id' => 'required | exists:return_barang,return_id',

        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(ReturnBarang::class, ['return_id' => $id]);
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
}
