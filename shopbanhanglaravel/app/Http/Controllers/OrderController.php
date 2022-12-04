<?php

namespace App\Http\Controllers;

use App\Models\CategoryProductModel;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Statistical;
use App\Models\Brand;
use PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function manage_order(){
        $order = Order::orderby('created_at', 'DESC')->get();
        return view('admin.order.manage_order')->with(compact('order'));
    }

    public function view_order($order_code){
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_code = $ord->order_code;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $order_code_cus = Order::where('order_code', $order_code)->first();
        
        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach($order_details_product as $key => $order_coupon){
            $product_coupon = $order_coupon->product_coupon;
        }
        if($product_coupon != '0'){
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        return view('admin.order.view_order')->with(compact(
            'order_details', 'customer', 'shipping', 'coupon_condition', 'coupon_number', 'order_code_cus', 'order', 'order_status'
        ));
    }
    
    public function print_order($checkout_code){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::where('order_code', $checkout_code)->get();
        $order = Order::where('order_code', $checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
        foreach($order_details_product as $key => $order_coupon){
            $product_coupon = $order_coupon->product_coupon;
        }
        if($product_coupon != '0'){
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();

            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
            if($coupon_condition == 1){
                $coupon_echo = $coupon_number.'%';
            }elseif($coupon_condition == 2){
                $coupon_echo = number_format($coupon_number,0,',','.').'đ';
            }
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
            $coupon_echo = "0";
        }
        $output = '';
        $output .='
        <style>
           body{
                font-family: DejaVu Sans;
           } 
           .table-styling{
                border: 1px solid #000;
           }
           .table-styling tr td{
                border: 1px solid #000;
           }
        </style>
        <h1><center>Cửa Hàng Luck-Shop</center></h1>
        <h4><center>Thế Giới Đồ Công Nghệ</center></h4>
        <p>Người Đặt Hàng</p>
        <Table class="table-styling">
            <thead>
                <th>Tên khách hàng</th>
                <th>Số Điện Thoại</th>
                <th>Email</th>
            </thead>
            <tbody>';
            $output .='
                <tr>
                    <td>'.$customer->customer_name.'</td>
                    <td>'.$customer->customer_phone.'</td>
                    <td>'.$customer->customer_email.'</td>
                </tr>';
            $output .= '
            </tbody>
        </Table>

        <p>Thông Tin Giao Hàng</p>
        <Table class="table-styling">
            <thead>
                <th>Tên Người Nhận</th>
                <th>Số Điện Thoại</th>
                <th>Địa Chỉ</th>
            </thead>
            <tbody>';
            $output .='
                <tr>
                    <td>'.$shipping->shipping_name.'</td>
                    <td>'.$shipping->shipping_phone.'</td>
                    <td>'.$shipping->shipping_address.'</td>
                </tr>';
            $output .= '
            </tbody>
        </Table>

        <p>Thông Tin Đơn Hàng</p>
        <Table class="table-styling">
            <thead>
                <th>Tên Sản Phẩm</th>
                <th>Giá Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Mã Giảm Giá</th>
                <th>Tổng Tiền</th>
            </thead>
            <tbody>';
            $total = 0;
            foreach($order_details as $key => $ord_product){
                $total_fee = 35000;
                $subtotal = $ord_product->product_price * $ord_product->product_sales_quantity;
                $total += $subtotal;
                if($ord_product->product_coupon != "0"){
                    $product_coupon = $ord_product->product_coupon;
                }else{
                    $product_coupon = "Không";
                }
                $output .='
                    <tr>
                        <td>'.$ord_product->product_name.'</td>
                        <td>'.number_format($ord_product->product_price,0,',','.').'đ'.'</td>
                        <td>'.$ord_product->product_sales_quantity.'</td>
                        <td>'.$product_coupon.'</td>
                        <td>'.number_format($subtotal,0,',','.').'đ'.'</td>
                    </tr>';
            }
            if($coupon_condition == 1){
                $total_after_coupon = ($total * $coupon_number) / 100;
                $total_coupon = $total - $total_after_coupon;
            }else{
                $total_coupon = $total - $coupon_number;
            }
            $output .= '<tr>
                <td colspan = "2">
                    <p>Tổng Tiền: '.$total.'</p>
                    <p>Tổng Giảm: '.$coupon_echo.'</p>
                    <p>Phí Vận Chuyển: '.number_format($total_fee,0,',','.').'đ'.'</p>
                    <p>Tổng Hóa Đơn: '.number_format($total_coupon + $total_fee,0,',','.').'đ'.'</p>
                </td>
            </tr>';
            $output .= '
            </tbody>
        </Table>
        ';
        return $output;
    }

    public function update_order_qty(Request $request){
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        $order_date = $order->order_date;
        $statistic = Statistical::where('order_date',$order_date)->get();

        if($statistic){
            $statistic_count = $statistic->count();
        }else{
            $statistic_count = 0;
        }
        
        if($order->order_status == 2){
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;

                $product_price = $product->product_price;
                $product_original_price = $product->product_original_price;
                $now =Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach($data['quantity'] as $key2 => $qty){
                    
                    if($key == $key2){
                        $product_remain = $product_quantity - $qty;
                        $product->product_quantity = $product_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                        
                        $quantity += $qty;
                        $sales += $product_price * $qty;
                        $profit += ($product_price*$qty)-($product_original_price*$qty);
                    }
                }
            }
            if($statistic_count>0){
                $static_update = Statistical::where('order_date', $order_date)->first();
                $static_update->sales = $static_update->sales + $sales;
                $static_update->profit = $static_update->profit + $profit;
                $static_update->quantity = $static_update->quantity + $quantity;
                $static_update->total_order = $static_update->total_order + 1;
                $static_update->save();
            }else{
                $new_statistic = new Statistical();
                $new_statistic->order_date = $order_date;
                $new_statistic->sales = $sales;
                $new_statistic->profit = $profit;
                $new_statistic->quantity = $quantity;
                $new_statistic->total_order = $total_order + 1;
                $new_statistic->save();
            }
        } 
    }

    public function update_qty(Request $request){
        $data = $request->all();
        $order_details = OrderDetails::where('product_id', $data['order_product_id'])->where('order_code', $data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }

    public function history(Request $request){
        if(!session()->get('customer_id')){
            return Redirect::to('/login-checkout')->with('message', 'Vui Lòng Đăng Nhập Để Xem Lịch Sử Đơn Hàng!!!');
        }else{
            
            $meta_desc = "Lịch Sử Đơn Hàng";
            $meta_keywords = "Lịch Sử Đơn Hàng";
            $meta_title = "Lịch Sử Đơn Hàng";
            $url_canonical = $request->url();
            //End Seo
            $cate_product = CategoryProductModel::where('category_status', '1')->orderBy('category_id','desc')->get();
            $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id','desc')->get();
            $getorder = Order::where('customer_id', session()->get('customer_id'))->orderBy('order_id', 'DESC')->paginate(10);
           
            return view('pages.history.history')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('getorder', $getorder)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical)
            ->with('i', (request()->input('page', 1) - 1) * 6);
        }
    }

    public function view_history_order(Request $request, $order_code){
        if(!session()->get('customer_id')){
            return Redirect::to('/login-checkout')->with('message', 'Vui Lòng Đăng Nhập Để Xem Lịch Sử Đơn Hàng!!!');
        }else{
            
            $meta_desc = "Lịch Sử Đơn Hàng";
            $meta_keywords = "Lịch Sử Đơn Hàng";
            $meta_title = "Lịch Sử Đơn Hàng";
            $url_canonical = $request->url();
            //End Seo
            $cate_product = CategoryProductModel::where('category_status', '1')->orderBy('category_id','desc')->get();
            $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id','desc')->get();
           
            $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
            $getorder = Order::where('order_code', $order_code)->first();

            $customer_id = $getorder->customer_id;
            $shipping_id = $getorder->shipping_id;
            $order_status = $getorder->order_status;

            $customer = Customer::where('customer_id', $customer_id)->first();
            $shipping = Shipping::where('shipping_id', $shipping_id)->first();

            $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
    
            foreach($order_details_product as $key => $order_coupon){
                $product_coupon = $order_coupon->product_coupon;
            }
            if($product_coupon != '0'){
                $coupon = Coupon::where('coupon_code', $product_coupon)->first();
                $coupon_condition = $coupon->coupon_condition;
                $coupon_number = $coupon->coupon_number;
            }else{
                $coupon_condition = 2;
                $coupon_number = 0;
            }
            return view('pages.history.view_history')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical)
            ->with('order_details', $order_details)
            ->with('customer', $customer)
            ->with('shipping', $shipping)
            ->with('coupon_condition', $coupon_condition)
            ->with('coupon_number', $coupon_number)
            ->with('getorder', $getorder)
            ->with('order_status', $order_status);
        }
    }

    public function cancel_order(Request $request){
        $data = $request->all();
        $order = Order::where('order_code', $data['id'])->first();
        $order->order_destroy = $data['reason'];
        $order->order_status = 3;
        $order->save();
    }
}
