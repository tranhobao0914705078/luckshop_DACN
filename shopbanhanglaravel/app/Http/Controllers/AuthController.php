<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_auth(){
        return view('admin.authentication.register');
    }
    
    public function register(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        return Redirect('/admin')->with('message', 'Đăng Ký Thành Công');
    }

    public function login_auth(){
        return view('admin.authentication.login_authen');
    }

    public function login(Request $request){
        $data = $request->all();
        if(Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])){
            return Redirect('/dashboard');
        }else{
            return Redirect('/login-auth')->with('message', 'Vui Lòng Kiểm Tra Lại Thông Tin Đăng Nhập!!!');
        }
    }

    public function logout_auth(){
        Auth::logout();
        return Redirect('/login-auth')->with('message', 'Đăng Xuất Quản Trị Viên Thành Công!!!');
    }

}
