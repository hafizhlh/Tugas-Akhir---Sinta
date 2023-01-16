<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use App\Models\Menu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('landingPage', $data);
    }

    public function datatables()
    {
        $data = LandingPage::orderBy('status', 'asc')->where('delete_mark', 0)->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->uuid . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editLandingPage">Edit</a>';
                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->uuid . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLandingPage">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $attributes = $request->only([
            'urutan',
            'judul',
            'gambar',
            'url',
            'status',
            'created_by',
            'updated_by',
            'delete_mark',
        ]);
        $roles = [
            'urutan' => 'required',
            'judul' => 'required',
            'gambar' => 'required | mimes:jpeg,jpg,png',
            'url' => 'required',
            'status' => 'required',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'mimes' => trans('messages.mimes'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {
            $attributes['created_by'] = Auth::user()->id;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/landingPage'), $name);
                $attributes['gambar'] = $name;
            }
            $data = LandingPage::create($attributes);
            DB::commit();
            $response = responseSuccess(trans("messages.create-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            $response = responseFail(trans("messages.create-fail"), $th->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function show($uuid)
    {
        $attributes['uuid'] = $uuid;

        $roles = [
            'uuid' => 'required|exists:landing_page',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(LandingPage::class, ['uuid' => $uuid]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update($uuid, Request $request)
    {

        $attributes = $request->only(['urutan', 'judul', 'gambar', 'url', 'status', 'updated_by', 'delete_mark']);

        $roles = [
            'urutan' => 'required',
            'judul' => 'required',
            'gambar' => 'mimes:jpeg,jpg,png',
            'url' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(LandingPage::class, ['uuid' => $uuid]);

        DB::beginTransaction();
        try {
            $attributes['updated_by'] = Auth()->user()->id;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/landingPage'), $name);
                $attributes['gambar'] = $name;
            }
            $data->update($attributes);
            DB::commit();
            $response = responseSuccess(trans("messages.update-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response = responseFail(trans("messages.update-fail"), $e->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function destroy($uuid)
    {
        $attributes['uuid'] = $uuid;

        $roles = [
            'uuid' => 'required|exists:landing_page',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];
        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(LandingPage::class, ['uuid' => $uuid]);
        DB::beginTransaction();
        try {
            $data->update([
                'delete_mark' => 1,
                'updated_by' => Auth::user()->id,
                'deleted_by' => Auth::user()->id,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            DB::commit();
            $response = responseSuccess(trans("messages.delete-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response = responseFail(trans("messages.create-fail"), $e->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }
}
