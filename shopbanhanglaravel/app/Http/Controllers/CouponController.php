<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    public function insert_coupon(){
        return view('admin.coupon.insert_coupon');
    }

    public function insert_coupon_code(Request $request){
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_date_start = $data['coupon_date_start'];
        $coupon->coupon_date_end = $data['coupon_date_end'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_status = $data['coupon_status'];
        $coupon->save();
        session()->put('message', 'Thêm mã giảm giá thành công!!!');
        return Redirect::to('list-coupon');
    }

    public function list_coupon(){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $coupon = Coupon::orderby('coupon_id', 'DESC')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon', 'today'));
    }

    public function delete_coupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        session()->put('message', 'Xóa mã giảm giá thành công!!!');
        return Redirect::to('list-coupon');
    }
}
