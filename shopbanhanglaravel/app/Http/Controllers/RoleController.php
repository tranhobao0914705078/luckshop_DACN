<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();
use App\Models\Roles;


class RoleController extends Controller
{
    public function all_role(){
        $role = Roles::orderby('id_roles', 'DESC')->paginate(5);
        return view('admin.roles.all_role')->with(compact('role'));
    }

    public function add_role(Request $request){
        $data = $request->all();
        $role = new Roles();
        $role->name = $data['name'];
        $role->role_desc = $data['role_desc'];
        $role->save();
        session()->put('message', 'Thêm Quyền thành công!!!');
        return Redirect()->back();
    }

    public function delete_roles($id_roles){
        $role = Roles::find($id_roles);
        $role->delete();
        return Redirect()->back()->with('message', 'Xóa Quyền Thành Công');
    }
}
