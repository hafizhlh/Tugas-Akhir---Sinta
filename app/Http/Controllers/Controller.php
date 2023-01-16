<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;
use Spatie\Permission\Models\Role;
use App\Models\RoleHasMenu;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getDashboardMenu()
    {
        $user = Auth::user();
        $datas['role']=Role::wherein('name',$user->getRoleNames())->where('guard_name','web')->get()->pluck('id');
        $datas['menu']=RoleHasMenu::select('menu_id')->wherein('role_id',$datas['role'])->get()->pluck('menu_id')->unique();
    	$arr = Menu::where('type','dashboard')->wherein('id',$datas['menu'])->where('status','y')->orderBy('order_no', 'ASC')->get()->toArray();
    	return $this->buildTree($arr,0);
    }

    public function getMenuLanding()
    {
       $arr = Menu::where('type','landing')->get()->toArray();
       return $this->buildTree($arr,0);
    }

    private function buildTree(array $elements, $parentId = 0) {
	    $branch = array();

	    foreach ($elements as $element) {
	        if ($element['parent_id'] == $parentId) {
	            $children = $this->buildTree($elements, $element['id']);
	            if ($children) {
	                $element['menu_childs'] = $children;
	            }
	            $branch[] = $element+=['menu_childs'=>[]];
	        }
	    }

	    return $branch;
	}

	public function validators($datas, $roles,$messages, $type = null)
	{
		$validator = Validator::make($datas,$roles,$messages);

        if ($validator->fails()) {
        	 $response = [
                'success' => false,
                'status' => 'fails',
                'message' => trans("messages.validate-check-fail"),
                'messages' => $validator->errors(),
            ];
            if($type == 1){
                return $validator->messages()->all();
            }else{
                $return = response()->json($response, 400, [], JSON_PRETTY_PRINT);  
                $return->throwResponse();
            }
        }
    }
    
    public function filterColumn($columns, $request, $query)
    {
        foreach ($columns as $key => $value) {
            if ($request->has($value)) {
                $this->searchColumn($key, $value, $request, $query);
            }
        }
    }

    public function filterColumnDataTable($columns, $request, $query)
    {
        if($request['search']['value']!=""){
            $query->where(function($query) use ($columns,$request){
                foreach ($columns as $key => $value) {
                   $query->orWhere($key, 'like', "%{$request['search']['value']}%");
                }
             });
        }
        $this->filterColumnDataTableInvidual($columns, $request, $query);
    }

    public function searchColumn($key, $value, $request, $query)
    {
        if ($request->get($value)) {
            $query->where($key, 'like', "%{$request->get($value)}%");
        }
    }

    public function filterColumnDataTableInvidual($columns,$request,$query)
    {
        // $where=[];
        foreach ($request['columns'] as $key => $value) {
            if($value['search']['value']!=""){
                foreach ($columns as $colk => $val) {
                    if ($value['name']==$val) {
                        // $where[$colk]=;
                        $query->Where($colk, 'like', "%".$value['search']['value']."%");
                        // $query->->orWhereRaw('{$colk}', 33333);
                    }
                }
            }
        }

        // return $where;
            
    }

    public function orderColumn($columns, $request, $query)
    {
        $order     = $request->get('order');
        $kolom     = $request->get('columns');
        $field     = $kolom[$order[0]['column']]['name'];
        $direction = $order[0]['dir'];
        foreach ($columns as $key => $value) {
            if ($field == $value) {
                $query->orderBy($key, $direction);
            }
        }
    }
    
    public function findDataWhere($model, $where)
    {
        $data = $model::where($where)->first();
        if ($data) {
            return $data;
        } else {
            $response = responseFail(trans('messages.data-not-found'));
            $return   = response()->json($response, 404, [], JSON_PRETTY_PRINT);
            $return->throwResponse();
        }
    }
}
