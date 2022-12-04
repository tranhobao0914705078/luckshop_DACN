<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;
use App\Models\CategoryProductModel;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CategoryProduct extends Controller
{
    public function AuthenLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_product(){
        $this->AuthenLogin();
        return view('admin.category.add_category_product');
    }

    public function all_category_product(){
        $this->AuthenLogin();
        $all_category_product = CategoryProductModel::orderby('tbl_category_product.category_id','desc')->get();
        $manager_category_product = view('admin.category.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.category.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request){
        $this->AuthenLogin();
        $data = $request->all();
        $category = new CategoryProductModel();
        $category->category_name = $data['category_product_name'];
        $category->slug_category_product = $data['slug_category_product'];
        $category->category_desc = $data['category_product_desc'];
        $category->meta_keywords = $data['category_product_keywords'];
        $category->category_status = $data['category_product_status'];
        $category->created_at = now();
        $category->save();
        session()->put('message', 'Thêm Danh Mục Thành Công!!!');
        return Redirect::to('all-category-product');
    }

    public function unactive_category_product($category_product_id){
        $this->AuthenLogin();
        CategoryProductModel::where('category_id', $category_product_id)->update(['category_status' => 1]);
        session()->put('message', 'Kích Hoạt Danh Mục Sản Phẩm Thành Công!!!');
        return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id){
        $this->AuthenLogin();
        CategoryProductModel::where('category_id', $category_product_id)->update(['category_status' => 0]);
        session()->put('message', 'Khóa Danh Mục Sản Phẩm Thành Công!!!');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->AuthenLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.category.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.category.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request,$category_product_id){
        $this->AuthenLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['updated_at'] = now();
        CategoryProductModel::where('category_id', $category_product_id)->update($data);
        session()->put('message', 'Cập Nhật Danh Mục Sản Phẩm Thành Công!!!');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){
        $this->AuthenLogin();
        CategoryProductModel::where('category_id', $category_product_id)->delete();
        session()->put('message', 'Xóa Danh Mục Sản Phẩm Thành Công!!!');
        return Redirect::to('all-category-product');
    }

    // end Admin

    public function show_category_home(Request $request, $category_id){
        $cate_product = CategoryProductModel::where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id','desc')->get();

        //$category_by_slug = CategoryProductModel::where('slug_category_product', $slug_category_product)->get();

        // foreach($category_by_slug as $key =>$cate){
        //     $category_id = $cate->category_id;
        // }
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by == 'giam_dan'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->orderBy('product_price', 'DESC')->paginate(6)->appends(request()->query());
            }elseif($sort_by == 'tang_dan'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            }elseif($sort_by == 'kytu_za'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->where('product_status', '1')->orderBy('product_name', 'DESC')->paginate(6)->appends(request()->query());
            }elseif($sort_by == 'kytu_az'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
            }
        }else{
            $category_by_id = Product::with('category')->where('category_id', $category_id)->where('product_status', '1')->orderBy('product_id', 'DESC')->paginate(6)->appends(request()->query());
        }
        
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id', $category_id)->limit(1)->paginate(6);
        
        foreach($cate_product as $key => $val){
            //Seo
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->category_name;
            $url_canonical = $request->url();
            //End Seo
        }
        return view('pages.category.show_category')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('category_by_id', $category_by_id)
        ->with('category_name', $category_name)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical)
        ->with('i', (request()->input('page', 1) - 1) * 6);
    }
}
