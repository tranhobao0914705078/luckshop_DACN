<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\CategoryProductModel;
use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class MailController extends Controller
{
    // public function send_mail(){
    //     $to_name = "LuckShop";
    //     $to_email = "tranhobao1812@gmail.com";

    //     $data = array("name" => "Mail Test", "body" => "Mail can xu ly");

    //     Mail::send('pages.send_mail', $data, function($message) use ($to_name, $to_email){
    //         $message->to($to_email)->subject('Test thu mail google');
    //         $message->form($to_email, $to_name);
    //     });
    //     return redirect('/')->with('message', '');
    // }

    public function forgetPassword(Request $request){
            $meta_desc = "Quên Mật Khẩu";
            $meta_keywords = "Quên Mật Khẩu";
            $meta_title = "Quên Mật Khẩu";
            $url_canonical = $request->url();
            //End Seo
            $cate_product = CategoryProductModel::where('category_status', '1')->orderBy('category_id','desc')->get();
            $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id','desc')->get();
            return view('pages.customer.forgetPassword')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
    }

    public function recover_pass(Request $request){
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Yêu cầu Lấy Lại Mật Khẩu".' '.$now;
        $customer = Customer::where('customer_email','=',$data['email_account'])->get();
        foreach($customer as $key => $val){
            $customer_id = $val->customer_id;
        }
        if($customer){
            $count_customer = $customer->count();
            if($count_customer == 0){
                return redirect()->back()->with('errorMail', 'Email Chưa Được Đăng Ký!!!');
            }else{
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();

                $to_email = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['email_account']);

                Mail::send('pages.customer.forget_pass_notify', ['data'=>$data], function($message) use ($title_mail, $data){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });
               
                return redirect()->back()->with('messageMail', 'Một Đường Link Thay Đổi Mật Khẩu Đã Được Gửi Đến Mail Của Bạn Vui Lòng Kiểm Tra Email!!!');
            }
        }
    }

    public function update_new_pass(Request $request){
        $meta_desc = "Quên Mật Khẩu";
        $meta_keywords = "Quên Mật Khẩu";
        $meta_title = "Quên Mật Khẩu";
        $url_canonical = $request->url();
        //End Seo
        $cate_product = CategoryProductModel::where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id','desc')->get();
        return view('pages.customer.new_pass')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function reset_new_pass(Request $request){
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
        $count = $customer->count();
        if($count>0){
            foreach($customer as $key => $val){
                $customer_id = $val->customer_id;
            }
            $reset = Customer::find($customer_id);
            if($data['new_password'] == $data['cofirm_password']){
                $reset->customer_password = md5($data['new_password']);
                $reset->customer_token = $token_random;
                $reset->save();
                return Redirect::to('/login-checkout')->with('message', 'Cập Nhật Mật Khẩu Thành Công!!!');
            }else{
                return redirect()->back()->with('error', 'Mật Khẩu Xác Nhận Không Trùng Khớp Với Mật Khẩu Mới!!!');
            }
        }else{
            return redirect('forgetPassword')->with('error', 'Vui Lòng Nhập Lại Email Vì Link Đã Quá Hạn');
        }
    }
}
