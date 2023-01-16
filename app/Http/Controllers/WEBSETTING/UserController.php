<?php

namespace App\Http\Controllers\WEBSETTING;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use DataTables;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Spatie\Permission\Models\Role;
use App\Http\Requests\ChangePasswordRequest;
use Storage;

use App\Rules\ExcelRule;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['company'] = Company::all();
        $data['roles'] = Role::all();
        return view('websetting.user',$data);
    }

    public function datatables(Request $request)
    {
        $query      = User::with('roles')->get();

        $data       = DataTables::of($query)->make(true);
        $response   = $data->getData(true);

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function list(Request $request)
    {
        $query      = User::with('roles')->get();

        $data       = DataTables::of($query)->make(true);
        $response   = $data->getData(true);
        
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function simulate($id)
    {
        $user = User::find($id);
        Auth::user()->impersonate($user);
        return responseSuccess(trans("message.simulate-user"), []);
    }

    public function leaveSimulate()
    {
        Auth::user()->leaveImpersonation();
        return redirect('/');
    }

    public function show($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:users',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);
        $user = User::find($id);
        $data     = $this->findDataWhere(User::class, ['id' => $id]);
        $data['role_name'] = $user->getRoleNames();
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $attributes = $request->only('email', 'username', 'roles','company','first_name','last_name');

        $roles = [
            'email'     => 'required|email|unique:users',
            'username'  => 'required|unique:users',
            'roles'     => 'required',
            'company'   => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ];
        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
            'email'    => trans('messages.email'),
        ];
        $this->validators($attributes, $roles, $messages);

        $roles = $request->roles;


        DB::beginTransaction();
        try {
            //$attributes['password'] = Hash::make("randompassword123");
            //$attributes['company_code'] = "A000";
            $user = new User();
            $user->email = $attributes['email'];
            $user->company_code = $attributes['company'];
            $user->username = $attributes['username'];
            $user->password = Hash::make("123pihc");
            $user->first_name = $attributes['first_name'];
            $user->last_name = $attributes['last_name'];
            $user->save();
            $user = User::where("username",$request->username)->first();
            $user->assignRole($roles);
            //$user->assignRole($request->roles);

            DB::commit();

            $response = responseSuccess(trans("messages.create-success"), $user);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            $response = responseFail(trans("messages.create-fail"), $th->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function syncronRole($id, Request $request)
    {
        is_uuid($id);
        $attributes = $request->only(['data']);
        $user       = User::where('id', $id)->first();

        if (empty($attributes)) {
            $user->syncRoles();
        } else {
            $user->syncRoles($attributes);
        }

        $response = responseSuccess(trans("messages.delete-success"), ['data' => $attributes]);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function destroy($id)
    {
        is_uuid($id);
        DB::beginTransaction();
        try {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $data = User::where('id', $id)->delete();
            DB::commit();
            $response = responseSuccess(trans("messages.delete-success"), ['data' => $id]);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response           = responseFail(trans("messages.delete-fail"));
            $response['errors'] = $e->getMessage();
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function resetpassword($uuid, Request $request)
    {
        is_uuid($uuid);
        $attributes       = $request->only(['uuid', 'password', 're-password']);
        $attributes['id'] = $uuid;

        $roles = [
            'id'          => 'exists:users',
            'password'    => 'required',
            're-password' => 'same:password',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
            'exists'   => trans('messages.exists'),
            'same'     => trans('messages.same'),
        ];
        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {
            $data = User::where('id', $uuid)->first();
            $data->update(['password' => Hash::make($attributes['password'])]);
            DB::commit();
            $response = responseSuccess(trans("messages.update-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response           = responseFail(trans("messages.update-fail"));
            $response['errors'] = $e->getMessage();
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }

    }

    public function update(User $uuid,UserRequest $request)
    {
        $uuid->company_code = $request->companyEdit;
        $uuid->first_name = $request->firstNameEdit;
        $uuid->last_name = $request->lastNameEdit;
        $uuid->save();
        $uuid->roles()->detach();
        $uuid->assignRole($request->rolesEdit);
        return response()->json($uuid, 200, [], JSON_PRETTY_PRINT);


    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json($user, 200, [], JSON_PRETTY_PRINT);

    }

    public function template(){
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('directoryx')
            ->setLastModifiedBy('directoryx')
            ->setTitle('Template User upload');

        $sheetIndex = $spreadsheet->getIndex(
            $spreadsheet->getSheetByName('Worksheet')
        );
        $spreadsheet->removeSheetByIndex($sheetIndex);

        // Create a new worksheet called "My Data"
        $myWorkSheet = new Worksheet($spreadsheet, 'Users');

        // Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
        $spreadsheet->addSheet($myWorkSheet, 0);

        // Create a new worksheet called "My Data"
        $myWorkSheet = new Worksheet($spreadsheet, 'Roles');

        // Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
        $spreadsheet->addSheet($myWorkSheet, 1);

        // Create a new worksheet called "My Data"
        $myWorkSheet1 = new Worksheet($spreadsheet, 'Company');

        // Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
        $spreadsheet->addSheet($myWorkSheet1, 2);

        $sheet = $spreadsheet->getSheet(1);
        $sheet->setCellValue('A1', 'Roles');

        $roles = Role::all();

        $x = 2;
        $sheet->getProtection()->setSheet(true);
        foreach ($roles as $role) {
            $sheet->setCellValue('A' . $x, $role->name);
            $sheet->getStyle('A'.$x)->getProtection()->setLocked(false);
            $sheet->getStyle('A'.$x)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
            $x++;

        }

        $sheet = $spreadsheet->getSheet(2);
        $sheet->setCellValue('A1', 'Company');
        $companies = Company::all();
        $x = 2;
        $sheet->getProtection()->setSheet(true);
        foreach ($companies as $company) {
            $sheet->setCellValue('A' . $x, $company->company_code."-".$company->company_name);
            $sheet->getStyle('A'.$x)->getProtection()->setLocked(false);
            $sheet->getStyle('A'.$x)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
            $x++;

        }

        $sheet = $spreadsheet->getSheet(0);

        $arr = ["Username", "First name", "Last name", "Email", "Roles", "Company"];
        $a = 0;
        foreach (range('A', 'F') as $v) {
            $sheet->setCellValue($v . '1', $arr[$a]);
            $a++;
        }

        $spreadsheet->getSheet(0)->setDataValidation(
            'E2:E100',
            (new DataValidation())
                ->setType(DataValidation::TYPE_LIST)
                ->setShowDropDown(true)
                ->setFormula1("='Roles'!A$2:A$23")
        );

        $spreadsheet->getSheet(0)->setDataValidation(
            'F2:F100',
            (new DataValidation())
                ->setType(DataValidation::TYPE_LIST)
                ->setShowDropDown(true)
                ->setFormula1("='Company'!A$2:A$23")
        );







        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="TemplateUser.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'excel' => ['required', new ExcelRule($request->file('excel'))],
        ]);
        $filename = $request->file('excel')->hashName();

        Storage::disk('public')->put('usertemplate', $request->file('excel'));

        $path = storage_path('app/public/usertemplate/' . $filename);

        $reader = new Xlsx();
        $spreadsheet = $reader->load($path);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        if(count($sheetData) >= 2){
            for ($c = 1; $c < count($sheetData); $c++) {
                
                if ($sheetData[$c][0] != "" && $sheetData[$c][1] != "" && $sheetData[$c][2] != "" && $sheetData[$c][3] != "" && $sheetData[$c][4] != "" && $sheetData[$c][5] != ""){
                    $companyCode = explode('-',$sheetData[$c][5]);
                    $userExist = User::withTrashed()
                        ->where("username",$sheetData[$c][0])
                        ->where("company_code",$companyCode)
                        ->first();                    
                    if(!$userExist){
                        $companyCode = explode('-',$sheetData[$c][5]);
                        $user = new User();
                        $user->email = $sheetData[$c][3];
                        $user->company_code = $companyCode[0];
                        $user->username = $sheetData[$c][0];
                        $user->password = Hash::make("123pihc");
                        $user->first_name = $sheetData[$c][1];
                        $user->last_name = $sheetData[$c][2];
                        $user->save();
                        $user = User::where("username",$sheetData[$c][0])->first();
                        $user->assignRole(strval($sheetData[$c][4]));
                    }else{
                        $companyCode = explode('-',$sheetData[$c][5]);
                        $update = DB::table('users')
                            ->where("username",$sheetData[$c][0])
                            ->where("company_code",$companyCode)
                            ->update([
                                'first_name' => $sheetData[$c][1],
                                'last_name' => $sheetData[$c][2],
                                'email' => $sheetData[$c][3],
                                'password' => Hash::make("123pihc")
                            ]);
                        $user = User::where("username",$sheetData[$c][0])->first();
                        $user->syncRoles(strval($sheetData[$c][4]));
                        // $user->assignRole(strval($sheetData[$c][4]));
                    }
                }
            }

            return redirect('usersetting');
        }
    }


}
