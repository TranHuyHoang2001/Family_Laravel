<?php

namespace App\Http\Controllers\Do_An;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function signIn(Request $request)
    {
        try {
            // Try to log the user in
//            dd($request->only(['email','password']));
            if (
                $user = Sentinel::authenticate($request->only(['email','password']), $request->get('remember-me', 0))) {
                $success = trans('auth/message.signin.success');
                return redirect(route('job.index'))->with('success', 'Đăng nhập thành công');
            }
            return redirect(route('login'))->with('error', 'Đăng nhập thất bại');
        } catch (\Exception $e) {
            return redirect(route('login'))->with('error', 'Đăng nhập thất bại');
        }
    }

    public function logout()
    {
        if (Sentinel::check()) {
            //Activity log
            Sentinel::logout();
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đăng xuất');
        }
        return redirect(route('login'))->with('success', 'Đăng xuất thành công');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        try {
            // Register the user
            $user = Sentinel::registerAndActivate($request->except('_token', 'password_confirmation'));
            //add user to 'User' group
            return redirect()->route('login')->with('success', 'Tạo tài khoản thành công');

        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $error = 'Đã xảy ra lỗi khi tạo tài khoản';
        }

        return redirect()->back()->withInput()->with('error', $error);

    }
}
