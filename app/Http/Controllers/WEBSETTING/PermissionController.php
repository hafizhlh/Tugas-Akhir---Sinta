<?php

namespace App\Http\Controllers\WEBSETTING;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Menu;
use DB;
use Auth;

use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('websetting.permission', $data);
    }

    public function datatables(Request $request)
    {
        $query    = Permission::get();
        $data     = DataTables::of($query)->make(true);
        $response = $data->getData(true);

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    function list(Request $request) {
        $columns = [
            'id'         => 'id',
            'name'       => 'name',
            'guard_name' => 'guard_name',
            'action_id'        => 'action_id',
        ];

        $query = Permission::select('*');
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

        $data     = $this->findDataWhere(Permission::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function destroy($id)
    {
        $attributes['id'] = $id;

        

        $data = $this->findDataWhere(Permission::class, ['id' => $id]);
        DB::beginTransaction();
        try {
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

    public function store(Request $request)
    {
        $attributes = $request->only(['parent_id', 'guard_name', 'action']);

        $roles = [
            'parent_id'  => 'required',
            'guard_name'       => 'required',
            'action' => 'required',
        ];
        $messages = [
            'required' => trans('messages.required'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {
            //code...
            $attributes['created_by'] = Auth::user()->id;
            $temp_action = $attributes['action'];
            $menu_data = Menu::where('id',$attributes['parent_id'])->first();
            $data = array();
            foreach ($temp_action as $act){
                $count = Permission::where('name',$menu_data->permission."-".$act)->where('action_id',$act)->count();
                if ($count == 0){
                    $data = array(
                        'name' => $menu_data->permission."-".$act,
                        'guard_name' => $attributes['guard_name'],
                        'menu_id' => $attributes['parent_id'],
                        'action_id' => $act
                    );
                    
                    $data = Permission::create($data);
                }
            }
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
}
