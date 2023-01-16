<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use DataTables;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Routes;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $query = new Company();
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        // $parent_company_code = $query->getCompanyParentID()->get();
        // $data['parent_company_code']=json_decode($parent_company_code, true);
        $data['parent_company_code']=Company::select('company_code', 'company_name')->get();
        return view('company', $data);
    }

    public function datatables(Request $request)
    {
        $query    = Company::get();
        $data     = DataTables::of($query)->make(true);
        $response = $data->getData(true);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = Company::create([
            'company_name' => $request->company_name,
            'company_code' => $request->company_code,  
            'parent_company_code' => $request->parent_company_code,
            // 'is_sap' => ($request->is_sap == null) ? '0' : $request->is_sap,
        ]);

        // $response = responseSuccess(trans('message.read-success'),$company);
        // return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($company)
    {

        $query   = Company::find($company);
        $response = responseSuccess(trans('message.read-success'),$query);
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query   = Company::find($id);
        $response = responseSuccess(trans("messages.read-success"), $query);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CompanyRequest $request)
    {
          $data = $this->findDataWhere(Company::class, ['id' => $id]);

        //   dd($data);exit();
          DB::beginTransaction();
          try {
              $data->update([
                  'company_name' => $request->company_name,
                  'company_code' => $request->company_code,
                  'parent_company_code' => $request->parent_company_code,
                  'is_sap' => ($request->is_sap == null) ? '0' : $request->is_sap, 
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

        Company::destroy($id);
        $response = responseSuccess(trans('message.delete-success'));
        return response()->json($response,200);
    }
}
