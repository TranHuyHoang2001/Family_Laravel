<?php

namespace App\Http\Controllers\Do_An;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword="";
        if($request->input('keyword')){
         $keyword = $request->input('keyword');
         }
         
         $users = User::where('first_name','LIKE',"%{$keyword}%")->paginate(10); 
                    
         return view('admin.user.list',compact('users'));
       
    }

    public function create()
    {
        return view('admin.user.add');
    }

    public function store(UserRequest $request)
    {
        try {
            // Register the user
            $user = Sentinel::registerAndActivate($request->except('_token', 'password_confirmation'));
            return redirect()->route('user.index')->with('success', 'Tạo tài khoản thành công');

        } catch (\Throwable $e) {
            $error = 'Đã xảy ra lỗi khi tạo tài khoản';
        }

        return redirect()->back()->withInput()->with('error', $error);
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user)
        {
            return view('admin.user.edit', compact('user'));
        }else {
            abort(404);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = Sentinel::findUserById($id);
            $data = [
                'email' => $request->email,
                'first_name' => $request->first_name,
                'password' => $request->password,
            ];
            $fromRequest = array_filter($data,'strlen');
            Sentinel::update($user, $fromRequest);
            $success = trans('users/message.success.update');
            return redirect()->route('user.index')->with('success','Cập nhật tài khoản thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Đã xảy ra lỗi khi cập nhật tài khoản');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete($id);
            return Redirect::route('users.index')->with('success','Xóa tài khoản thành công');
        }catch (\Exception $exception)
        {
            return Redirect::back()->withErrors('Xóa tài khoản thất bại');
        }
    }

}
