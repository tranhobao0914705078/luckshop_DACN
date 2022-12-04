<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CategoryProductModel;
use App\Models\Brand;

class CustomerController extends Controller
{
    public function view_profile(Request $request, $customer_id){
        if(!session()->get('customer_id')){
            return Redirect::to('/login-checkout')->with('message', 'Vui Lòng Đăng Nhập Để Xem Lịch Sử Đơn Hàng!!!');
        }else{
            $meta_desc = "Thế Giới Đồ Công Nghệ, Chuyên Các Dòng Laptop, PC, Điện Thoại...";
            $meta_keywords = "Thế Giới Đồ Công Nghệ";
            $meta_title = "Thế Giới Đồ Công Nghệ";
            $url_canonical = $request->url();
            //End Seo
            $cate_product = CategoryProductModel::where('category_status', '1')->orderBy('category_id','desc')->get();
            $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id','desc')->get();
    
            $customer = Customer::where('customer_id', $customer_id)->get();
    
            return view('pages.customer.profile_cus')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('customer', $customer)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
        }
    }
    public function update_profile(Request $request, $customer_id){
        if(!session()->get('customer_id')){
            return Redirect::to('/login-checkout')->with('message', 'Vui Lòng Đăng Nhập Để Xem Lịch Sử Đơn Hàng!!!');
        }else{
            $meta_desc = "Thế Giới Đồ Công Nghệ, Chuyên Các Dòng Laptop, PC, Điện Thoại...";
            $meta_keywords = "Thế Giới Đồ Công Nghệ";
            $meta_title = "Thế Giới Đồ Công Nghệ";
            $url_canonical = $request->url();
            //End Seo
            $cate_product = CategoryProductModel::where('category_status', '1')->orderBy('category_id','desc')->get();
            $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id','desc')->get();
    
            $customer = Customer::where('customer_id', $customer_id)->get();
    
            return view('pages.customer.change_info')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('customer', $customer)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
        }
    }

    public function update_profile_user($customer_id, Request $request){
       $data = array();
       $data['customer_name'] = $request->customer_name;
       $data['customer_email'] = $request->customer_email;
       $data['customer_password'] = $request->customer_password;
       $data['customer_phone'] = $request->customer_phone;
       if($data){
        Customer::where('customer_id', $customer_id)->update($data);
        session()->put('message', 'Cập Nhật Thành Công!!!');
        return Redirect::to('/trang-chu');
       }else{
        session()->put('error', 'Cập Nhật fail!!!');
        return redirect()->back();
       }
    }

    public function change_pass_cus($customer_id, Request $request){
        if(!session()->get('customer_id')){
            return Redirect::to('/login-checkout')->with('message', 'Vui Lòng Đăng Nhập Để Xem Lịch Sử Đơn Hàng!!!');
        }else{
            $meta_desc = "Thế Giới Đồ Công Nghệ, Chuyên Các Dòng Laptop, PC, Điện Thoại...";
            $meta_keywords = "Thế Giới Đồ Công Nghệ";
            $meta_title = "Thế Giới Đồ Công Nghệ";
            $url_canonical = $request->url();
            //End Seo
            $cate_product = CategoryProductModel::where('category_status', '1')->orderBy('category_id','desc')->get();
            $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id','desc')->get();
    
            $customer = Customer::where('customer_id', $customer_id)->get();
    
            return view('pages.customer.change_pass_user')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('customer', $customer)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
        }
    }  
    
    public function change_password_user($customer_id, Request $request){
        $cus = Customer::find($customer_id);
        if(md5($request->old_password) == $cus->customer_password){
           if($request->new_password == $request->cofirm_password){
                $cus->customer_password = md5($request->new_password);
                $cus->save();
                session()->put('message', 'Cập Nhật Mật Khẩu Thành Công!!!');
                return Redirect::to('/trang-chu');
           }else{
                session()->put('error', 'Mật Khẩu Xác Nhận Không Trùng Khớp Với Mật Khẩu Mới!!!');
                return redirect()->back();
           }
        }else{
            session()->put('error', 'Mật Khẩu Cũ Không Đúng!!!');
        }
        return redirect()->back();
    }
}
