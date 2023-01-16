<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use \Spatie\Permission\Models\Role;
use DataTables;
use Validator; 
use Mail; 
use Hash;

class ForgotPasswordController extends Controller
{
    
    public function index()
    {
        return view('forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
      {
        $attributes       = $request->only(['username', 'password', 're-password']);

        $roles = [
            'username'    => 'exists:users',
            'password'    => 'required',
            're-password' => 'same:password',
        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
            'exists'   => trans('messages.exists'),
            'same'     => trans('messages.same'),
        ];
        $result = $this->validators($attributes, $roles, $messages, 1);
        if($result){            
            return redirect('/forgetpassword')->with('message_error', $result[0]);
        }else{
            $cek = User::with('roles')->where('username', $attributes['username'])->get();
            if($cek[0]->roles[0]->name == 'ADMIN'){                
                return redirect('/forgetpassword')->with('message_error', 'Sorry, you cannot change the password!');
            }else{
                DB::beginTransaction();
                try {
                    $data = User::where('username', $attributes['username'])->first();
                    $data->update(['password' => Hash::make($attributes['password'])]);
                    DB::commit();
                    return redirect('/login')->with('message_success', 'Your password has been changed!');
                } catch (Exception $e) {
                    DB::rollback();
                    return redirect('/login')->with('message_error', 'Error Reset Password!');
                }
            }
        }
        // return redirect('/login')->with('message', 'Your password has been changed!');
      }
    
}
