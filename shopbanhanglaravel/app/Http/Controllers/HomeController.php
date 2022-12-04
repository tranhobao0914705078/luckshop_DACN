<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;

class HomeController extends Controller
{
    public function index(Request $request){
        //Seo
        $meta_desc = "Thế Giới Đồ Công Nghệ, Chuyên Các Dòng Laptop, PC, Điện Thoại...";
        $meta_keywords = "Thế Giới Đồ Công Nghệ";
        $meta_title = "Thế Giới Đồ Công Nghệ";
        $url_canonical = $request->url();
        //End Seo
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();

        $all_product = Product::where('product_status', '1')->orderBy('product_id', 'desc')->paginate(6);
        
        return view('pages.home')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product', $all_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical)
        ->with('i', (request()->input('page', 1) - 1) * 6);
        // cách 2 sửa lại các tên ở foreach -> return view('pages.home')->with(compact('cate_product)....)
    }

    public function search(Request $request){

        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();

        foreach($search_product as $key => $pro){
            $meta_desc = $pro->product_desc;
            $meta_keywords = $pro->product_keywords;
            $meta_title = $pro->product_name;
            $url_canonical = $request->url();
        }

        return view('pages.sanpham.search')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('search_product', $search_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function autocomplete_search(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = Product::where('product_status', '1')->where('product_name', 'LIKE', '%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block; margin: -30px -138px; width: 400px;">';
            foreach($product as $key => $val){
                $output .= '
                    <li><a href="#">'.$val->product_name.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
