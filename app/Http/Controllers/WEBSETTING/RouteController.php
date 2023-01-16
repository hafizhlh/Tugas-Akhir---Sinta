<?php

namespace App\Http\Controllers\WEBSETTING;

use App\Models\Routes;
use App\Models\GlobalVar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class RouteController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['menus']   = $this->getDashboardMenu();
        $data['methods'] = GlobalVar::select('value')->where([['group', 'ROUTE'],['name','METHOD']])->get();
        $data['permissions'] = Permission::all();
        return view('websetting.route', $data);
    }

    function list(Request $request) {
        $columns = [
            'id'         => 'id',
            'method'     => 'method',
            'url'        => 'url',
            'route'      => 'route',
            'guard'      => 'guard',
            'type'       => 'type',
            'middleware' => 'middleware',
            'permission' => 'permission',
        ];

        $query = Routes::select('id', 'method', 'url', 'route', 'guard', 'type', 'middleware', 'permission');
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

    public function datatables(Request $request)
    {
        $query    = Routes::get();
        $data     = DataTables::of($query)->make(true);
        $response = $data->getData(true);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $attributes = $request->all();

        $roles = [
            'method'     => 'required|in:GET,POST,PUT,DELETE,PUTCH',
            'url'        => 'required',
            'route'      => 'required',
            'guard'      => 'required|in:api,web',
            'type'       => 'required|in:data,view',
            'middleware' => 'required',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
            'in'       => trans('messages.in'),
        ];

        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {
            $attributes['created_by'] = Auth()->user()->id;
            $data = Routes::create($attributes);
            DB::commit();
            $response = responseSuccess(trans("messages.create-success"), $attributes);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response = responseFail(trans("messages.create-fail"), $th->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function destroy($id)
    {
        $data = $this->findDataWhere(Routes::class, ['id' => $id]);
        DB::beginTransaction();
        try {
            $data->delete();
            DB::commit();
            $response = responseSuccess(trans("messages.delete-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response           = responseFail(trans("messages.delete-fail"));
            $response['errors'] = $e->getMessage();
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function show($id, Request $request)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:routes',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(Routes::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update($id, Request $request)
    {
        $attributes = $request->only(['method', 'url', 'route', 'guard', 'type', 'permission', 'middleware']);

        $roles = [
            'method'     => 'required|in:GET,POST,PUT,DELETE,PUTCH',
            'url'        => 'required',
            'route'      => 'required',
            'guard'      => 'required|in:api,web',
            'type'       => 'required|in:data,view',
            'middleware' => 'required',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
            'in'       => trans('messages.in'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(Routes::class, ['id' => $id]);
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

}
