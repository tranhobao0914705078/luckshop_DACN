<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Statistical;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function AuthenLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthenLogin();
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $order_now = Order::where('order_date', $order_date)->orderBy('order_date', 'ASC')->get();
        $statistic_now = Statistical::where('order_date', $order_date)->get();
        return view('admin.dashboard')->with('order_now', $order_now)->with('statistic_now', $statistic_now);
    }

    public function dashboard(Request $request){
        $result = Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password]);
        if($result){
            return Redirect::to('/dashboard');
        }else{
            $request->session()->put('message','Vui lòng kiểm tra lại thông tin đăng nhập!!!');
            return Redirect::to('/admin');
        }
    }

    public function logout(){
        $this->AuthenLogin();
        session()->put('admin_name',null);
        session()->put('admin_id',null);
        return Redirect::to('/admin');
    }

    public function profile(){
        $admin = Admin::find(Auth::id());
        return view('admin.profile.profile')->with(compact('admin'));
    }

    public function change_pass(Request $request){
        $data = $request->all();
        $admin = Admin::find(Auth::id());
        if(md5($request->password_old) == $admin->admin_password){
            $admin->admin_password = md5($request->new_password);
            $admin->save();
            session()->put('message', 'Success');
            return Redirect::to('/dashboard');
        }else{
            session()->put('message', 'Mat khau cu khong dung');
        }
       return view('admin.profile.change-pass');
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistical::whereBetween('order_date', [$from_date,$to_date])->orderBy('order_date', 'ASC')->get();
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();

        $startMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $startMonthAgo = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $endMonthAgo = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7day'){
            $get = Statistical::whereBetween('order_date', [$sub7days,$now])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'monthAgo'){
            $get = Statistical::whereBetween('order_date', [$startMonthAgo,$endMonthAgo])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'month'){
            $get = Statistical::whereBetween('order_date', [$startMonth,$now])->orderBy('order_date', 'ASC')->get();
        }else{
            $get = Statistical::whereBetween('order_date', [$sub365days,$now])->orderBy('order_date', 'ASC')->get();
        }
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function days_order(Request $request){
        $data = $request->all();
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date',[ $sub30days, $now])->orderBy('order_date', 'ASC')->get();

        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
