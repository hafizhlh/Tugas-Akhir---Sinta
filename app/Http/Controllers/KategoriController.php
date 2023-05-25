<?php

namespace App\Http\Controllers;


use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Menu;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('Kategori', $data);
    }

    public function datatables()
    {
        $data = Kategori::orderBy('nama_kategori', 'asc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('nama_kategori', function ($row) {
                $kategori = $row->nama_kategori;
                if ($kategori == '') {
                    $kategori = 'Belum dikategorikan';
                } else {
                    $kategori = $row->nama_kategori;
                }
                return $kategori;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBarang">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletes">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $attributes = $request->only([
            'kategori_name', // Menambahkan field kategori_barang
        ]);
        $roles = [
            'kategori_name' => 'required', // Validasi untuk kategori_barang
        ];
        $messages = [
            'required' => trans('messages.required'),
            'unique' => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);


        DB::beginTransaction();
        try {
            $data = Kategori::create([
                'nama_kategori' => $request->kategori_name, // Menambahkan kolom kategori_barang
                'created_at' => now(),
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
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:kategori,id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists' => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(Kategori::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        return $id;
    }

    public function edit($id)
    {
        $query = Kategori::find($id);
        $response = responseSuccess(trans("messages.read-success"), $query);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        //
    }

    public function update($id, Request $request)
    {

        $attributes = $request->only([
            'kategori_code', // Menambahkan field kategori_barang
        ]);

        $roles = [
            'kategori_code' => 'required', // Validasi untuk kategori_barang
        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique' => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(Kategori::class, ['id' => $id]);

        DB::beginTransaction();
        try {
            $data->update([
                'nama_kategori' => $request->kategori_code, // Menambahkan kolom kategori_barang
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
        DB::beginTransaction();
        try {
            Kategori::where('id', $id)->delete();
            $response = responseSuccess(trans('message.delete-success'));
            DB::commit();
            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
    }
}
