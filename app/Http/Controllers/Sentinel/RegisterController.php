<?php

namespace App\Http\Controllers\Sentinel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterForm;
use Sentinel;
use Validator;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register()
    {
    	return view('auth.register');
    }

    public function postRegister(RegisterForm $request)
    {
    	
        $credentials = [
        	'first_name' => $request->first_name,
        	'last_name' => $request->last_name,
            'email'    => $request->email,
            'password' => $request->password
        ];

        $user = Sentinel::registerAndActivate($credentials);

        $role = Sentinel::findRoleBySlug('member');
        $role->users()->attach($user);
        
        // login = taikhoan do' sau khi dang ki'
        $credentials = [
            'login' => $request->email,
        ];

        $user = Sentinel::findByCredentials($credentials);
        Sentinel::login($user);
        
        return redirect()->route('admin.dashboard');
    }

     public function registerAjax(Request $request)
    {

        $validator = Validator::make($request->all(),[
                'first_name' => 'required',
                'last_name' => 'required',
                'email' =>'required|email|unique:users,email',
                'password' => 'required|min:2|confirmed'
            ]);

        if ($validator->fails()) {
             return \Response::json([
                    'errors' => true,
                    'message' => $validator->errors()
                ], 200);
        }
        else
           { 
                     $credentials = [
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email'    => $request->email,
                        'password' => $request->password
                    ];

                    $user = Sentinel::registerAndActivate($credentials);

                    $role = Sentinel::findRoleBySlug('member');
                    $role->users()->attach($user);
                    
                    // login = taikhoan do' sau khi dang ki'
                    $credentials = [
                        'login' => $request->email,
                    ];

                    $user = Sentinel::findByCredentials($credentials);
                    Sentinel::login($user);

                     return \Response::json([
                        'errors' => true,
                        'message' => 'success register'
                    ], 200);
           }
    }
}
