<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart; 
session_start();
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Carbon;

class CartController extends Controller
{   
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = session()->get('cart');
        if($cart==true){
            $is_aviable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_aviable++;
                }
            }
            if($is_aviable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' =>  $data['cart_product_price'],
                );
                session()->put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' =>  $data['cart_product_price'],
            );
            session()->put('cart', $cart);
        }
        session()->save();
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = session()->get('cart');
        if($cart == true){
            $message = '';
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id'] == $key && $qty < $cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty;
                        $message .= '<p class="text-success">Cập Nhật '.$cart[$session]['product_name'].' Thành Công!!!</p>';
                    }elseif($val['session_id'] == $key && $qty > $cart[$session]['product_quantity']){
                        $message .= '<p class="text-danger">Cập Nhật '.$cart[$session]['product_name'].' Thất Bại - Số Lượng Đặt Vượt Quá Giới Hạn!!!</p>';
                    }
                }
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('message', $message);
        }else{
            return redirect()->back()->with('error', 'Cập Nhật Giỏ Hàng Thất Bại!!!');
        }
    }

    public function delete_product($session_id){
        $cart = session()->get('cart');
        if($cart == true){
            foreach($cart as $key => $val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        }
    }

    public function delete_all_product(){
        $cart = session()->get('cart');
        if($cart == true){
            session()->forget('cart');
            session()->forget('coupon');
            return redirect()->back()->with('message', 'Xóa Giỏ Hàng Thành Công!!!');
        }
    }

    public function gio_hang(Request $request){
        $meta_desc = "Giỏ Hàng Của Bạn";
        $meta_keywords = "Giỏ Hàng";
        $meta_title = "Giỏ Hàng";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','desc')->get();

        return view('pages.cart.cart_ajax')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();
        $quantity = $request->qty;
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(10);
        return Redirect::to('/show-cart');
        //Cart::destroy();
    }

    public function show_cart(Request $request){
        $meta_desc = "Giỏ Hàng Của Bạn";
        $meta_keywords = "Giỏ Hàng";
        $meta_title = "Giỏ Hàng";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','desc')->get();

        return view('pages.cart.show_cart')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function delete_to_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }

    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }

    //coupon
    public function check_coupon(Request $request){
        $data = $request->all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $coupon = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->where('coupon_time', '>', 0)->first();
        if($coupon == true){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $coupon_session = session()->get('coupon');
                if($coupon_session == true){
                    $is_aviable = 0;
                    if($is_aviable == 0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        session()->put('coupon', $cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    session()->put('coupon', $cou);
                }
                session()->save();
                return redirect()->back()->with('message', 'Áp dụng mã giảm giá thành công!!!');
            }
        }else{
            return redirect()->back()->with('error', 'Mã Giảm Giá Không Tồn Tại Hoặc Đã Hết Hạn!!!');
        }
    }

}
