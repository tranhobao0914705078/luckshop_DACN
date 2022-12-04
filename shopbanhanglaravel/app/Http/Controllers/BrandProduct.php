<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\CategoryProductModel;
use App\Http\Requests;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
session_start();
use Illuminate\Support\Facades\Auth;

class BrandProduct extends Controller
{
    public function AuthenLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_brand_product(){
        $this->AuthenLogin();
        return view('admin.brand.add_brand_product');
    }

    public function all_brand_product(){
        $all_brand_product = Brand::orderBy('brand_id', 'DESC')->get();
        return view('admin.brand.all_brand_product')->with(compact('all_brand_product'));
    }

    public function save_brand_product(Request $request){
        $data = $request->all();
        $this->AuthenLogin();
        $get_image = $request->file('brand_product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/brand', $new_image);
            $brand = new Brand();
            $brand->brand_name = $data['brand_product_name'];
            $brand->brand_product_image = $new_image;
            $brand->brand_desc = $data['brand_product_desc'];
            $brand->brand_status = $data['brand_product_status'];
            $brand->save();
            session()->put('message', 'Thêm Thương Hiệu Thành Công!!!');
            return Redirect::to('all-brand-product');
        }else{
            session()->put('message', 'Vui Lòng Thêm Hình Ảnh Thương Hiệu!!!');
            return Redirect::to('all-brand-product');
        }
    }

    public function unactive_brand_product($brand_product_id){
        $this->AuthenLogin();
        Brand::where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        session()->put('message', 'Kích Hoạt Thương Hiệu Sản Phẩm Thành Công!!!');
        return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id){
        $this->AuthenLogin();
        Brand::where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        session()->put('message', 'Khóa Thương Hiệu Sản Phẩm Thành Công!!!');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id){
        $this->AuthenLogin();
        $edit_brand_product = Brand::where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('admin.brand.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function update_brand_product(Request $request,$brand_id){
        $this->AuthenLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $get_image = $request->file('brand_product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/brand', $new_image);
            $data['brand_product_image'] = $new_image;
            Brand::where('brand_id', $brand_id)->update($data);
            session()->put('message', 'Cập Nhật Thương Hiệu Sản Phẩm Thành Công!!!');
            return Redirect::to('all-brand-product');
        }
        Brand::where('brand_id', $brand_id)->update($data);
        session()->put('message', 'Cập Nhật Thương Hiệu Sản Phẩm Thành Công!!!');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthenLogin();
        Brand::where('brand_id', $brand_product_id)->delete();
        session()->put('message', 'Xóa Thương Hiệu Sản Phẩm Thành Công!!!');
        return Redirect::to('all-brand-product');
    }

    // end Admin-Brand
    public function show_brand_home(Request $request, $brand_id){
        $cate_product = CategoryProductModel::where('category_status', '1')->orderBy('category_id','desc')->paginate(6);
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id','desc')->get();

        $brand_by_id =  DB::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id','=','tbl_brand.brand_id')
        ->where('tbl_product.brand_id', $brand_id)->paginate(6);
        $brand_by_id = Product::with('category')->where('brand_id', $brand_id)->orderBy('product_id', 'DESC')->paginate(6);

        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id', $brand_id)->limit(1)->get();
        foreach($brand_name as $key => $val){
            //Seo
            $meta_desc = $val->brand_desc;
            $meta_keywords = $val->brand_desc;
            $meta_title = $val->brand_name;
            $url_canonical = $request->url();
            //End Seo
        }
        return view('pages.brand.show_brand')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('brand_by_id', $brand_by_id)
        ->with('brand_name', $brand_name)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }
}
