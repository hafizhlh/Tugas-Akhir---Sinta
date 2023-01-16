<?php

namespace App\Http\Controllers\WEBSETTING;

use App\Models\Menu;
use App\Models\RoleHasMenu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('websetting.menu', $data);
    }

    public function datatables(Request $request)
    {
        $query    = Menu::get();
        $data     = DataTables::of($query)->make(true);
        $response = $data->getData(true);

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    function list(Request $request) {
        $columns = [
            'id'         => 'id',
            'uuid'       => 'uuid',
            'name'       => 'name',
            'permission' => 'permission',
            'url'        => 'url',
            'order_no'   => 'order_no',
            'icon'       => 'icon',
            'parent_id'  => 'parent_id',
            'type'       => 'type',
            'status'     => 'status',
        ];

        $query = Menu::select('*');
        $data  = DataTables::of($query)
            ->filter(function ($query) use ($request, $columns) {
                $this->filterColumn($columns, $request, $query);
            })
            ->order(function ($query) use ($request, $columns) {
                $this->orderColumn($columns, $request, $query);
            })
            ->make(true);
        $response = $data->getData(true);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $attributes = $request->only(['name', 'url', 'icon', 'parent_id', 'type', 'permission']);

        $roles = [
            'name'       => 'required',
            'url'        => 'required|unique:menu',
            'icon'       => 'required',
            'parent_id'  => 'required',
            'type'       => 'required',
            'permission' => 'sometimes|unique:menu',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {
            //code...
            $attributes['created_by'] = Auth::user()->id;
            $data                     = Menu::create($attributes);
            DB::commit();
            $response = responseSuccess(trans("messages.create-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            $response = responseFail(trans("messages.create-fail"), $th->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }

    }

    public function show($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:menu',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(Menu::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update($id, Request $request)
    {

        $attributes = $request->only(['name', 'url', 'icon', 'parent_id', 'type','permission']);

        $roles = [
            'name'      => 'required',
            'icon'      => 'required',
            'parent_id' => 'required',
            'type'      => 'required',
            'permission' => 'required'
        ];
        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(Menu::class, ['id' => $id]);

        DB::beginTransaction();
        try {
            $attributes['updated_by'] = Auth()->user()->id;
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

    public function destroy($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:menu',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];
        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(Menu::class, ['id' => $id]);
        DB::beginTransaction();
        try {
            RoleHasMenu::where('menu_id', $id)->delete();
            $data->delete();
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
