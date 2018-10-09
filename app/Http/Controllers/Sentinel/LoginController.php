<?php

namespace App\Http\Controllers\Sentinel;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginForm;
use Sentinel;

class LoginController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
    	return view('auth.login');
    }

    public function postLogin(LoginForm $request)
    {
    	try {
	    	$credentials = [
			    'email'    => $request->email,
			    'password' => $request->password,
			];

			if($user = Sentinel::authenticate($credentials))
			{
				Sentinel::login($user);
				if(Sentinel::getUser()->inRole('admin'))
				{
					return redirect()->route('admin.dashboard');
				}
				return redirect()->route('home');
			}
			else
			{
				$err = "Tên đăng nhập hoặc mật khẩu không đúng!";
				//return redirect()->route('login');
			}
		} catch (ThrottlingException $e) 
		{
            $delay = $e->getDelay();
            $err = "Bạn bị block đăng nhập trong vòng {$delay} sec";
        }

        return redirect()->back()
            ->withInput()
            ->with('err', $err);
    }

    public function logout()
    {
    	Sentinel::logout();
    	return redirect('/home');
    }

    public function loginAjax(Request $request)
    {

        $validator = Validator::make($request->all(),[
                'email' =>'required|email',
                'password' => 'required|min:2'
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
                        'email'    => $request->email,
                        'password' => $request->password,
                    ];

                    if($user = Sentinel::authenticate($credentials))
                    {
                          Sentinel::login($user);
                          return \Response::json([
                            'errors' => false,
                            'message' => 'success',
                            'checkLogin' => true
                        ], 200);
                    }
                    else
                    {
                          return \Response::json([
                            'errors' => false,
                            'message' => 'success',
                            'checkLogin' => false
                        ], 200);
                    }
           }
    }
}