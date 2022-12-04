<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();
use App\Models\Admin;
use App\Models\Roles;

class UserController extends Controller
{
    public function index(){
        $admin = Admin::with('roles')->orderby('admin_id', 'DESC')->paginate(5);
        return view('admin.users.all_user')->with(compact('admin'));
    }

    public function assign_roles(Request $request){
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['author_role']){
            $user->roles()->attach(Roles::where('name','author')->first());
        }
        if($request['user_role']){
            $user->roles()->attach(Roles::where('name', 'user')->first());
        }
        if($request['admin_role']){
            $user->roles()->attach(Roles::where('name', 'admin')->first());
        }
        return Redirect()->back()->with('message', 'Cập Nhật Thành Công');
    }

    public function delete_user_roles($admin_id){
        if(Auth::id() == $admin_id){
            return Redirect()->back()->with('message', 'Không được tự xóa!!!');
        }
        $admin = Admin::find($admin_id);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        return Redirect()->back()->with('message', 'Xóa USer Thành Công');
    }
}
