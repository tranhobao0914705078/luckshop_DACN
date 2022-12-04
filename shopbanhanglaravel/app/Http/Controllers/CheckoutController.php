<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Coupon;
use App\Models\Customer;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart; 
session_start();
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function AuthenLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function view_order($orderId){
        $this->AuthenLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')
        ->first();
        $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
    }

    public function login_checkout(Request $request){
        $meta_desc = "Đăng Nhập Thanh Toán";
        $meta_keywords = "Đăng Nhập Thanh Toán";
        $meta_title = "Đăng Nhập Thanh Toán";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','desc')->get();

        return view('pages.checkout.login_checkout')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function add_customer(Request $request){

        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        session()->put('customer_id', $customer_id);
        session()->put('customer_name', $request->customer_name);

        return Redirect::to('/checkout');
    }

    public function checkout(Request $request){
        $meta_desc = "Checkout";
        $meta_keywords = "Checkout";
        $meta_title = "Checkout";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','desc')->get();

        return view('pages.checkout.show_checkout')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function logout_checkout(){
        session()->flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        
        if($result){
            session()->put('customer_id', $result->customer_id);
            session()->put('customer_name', $result->customer_name);
            return Redirect::to('/trang-chu');
        }else{
            $request->session()->put('error-login','Vui lòng kiểm tra lại thông tin đăng nhập!!!');
            return Redirect::to('/login-checkout');
        }
    }

    public function manage_order(){
        $this->AuthenLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manager_order', $manager_order);
    }

    //Ajax-Order
    public function confirm_order(Request $request){
        $data = $request->all();
        if($data['order_coupon'] != '0'){
            $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
            $coupon->coupon_time = $coupon->coupon_time -1;
            $coupon->save();
            $coupon_mail = $coupon->coupon_code;
        }else{
            $coupon_mail= 'Không Có';
        }
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);
        $order = new Order();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        $order->customer_id = session()->get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        $order->order_date = $order_date;
        $order->created_at = now();
        $order->save();

        if(session()->get('cart')){
            foreach(session()->get('cart') as $key => $cart){
                $order_details = new OrderDetails();
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->save();
            }
        }
        //send mail
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Đơn Hàng Xác Nhận Ngày".''.$now;
        $customer = Customer::find(session()->get('customer_id'));
        $data['email'][] = $customer->customer_email;
        if(session()->get('cart') == true){
            foreach(session()->get('cart') as $key => $cart_mail){
                $cart_array[] = array(
                    'product_name' => $cart_mail['product_name'],
                    'product_price' => $cart_mail['product_price'],
                    'product_qty' => $cart_mail['product_qty'],
                );  
            };
        }
        $shipping_array = array(
            'customer_name' => $customer->customer_name,
            'shipping_name' => $data['shipping_name'],
            'shipping_email' => $data['shipping_email'],
            'shipping_phone' => $data['shipping_phone'],
            'shipping_address' => $data['shipping_address'],
            'shipping_notes' => $data['shipping_notes'],
            'shipping_method' => $data['shipping_method'],
        );

        $ordercode_mail = array(
            'coupon_code' => $coupon_mail,
            'order_code' => $checkout_code
        );
        Mail::send('pages.mail.mail_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function($message) use ($title_mail, $data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        session()->forget('coupon');
        session()->forget('cart');
    }
}
