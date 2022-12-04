<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Rating;

class ProductController extends Controller
{
    public function AuthenLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_product(){
        $this->AuthenLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        return view('admin.product.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product(){
        $this->AuthenLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.product.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.product.all_product', $manager_product);
    }

    public function save_product(Request $request){
        $this->AuthenLogin();
        $data = $request->all();
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $product = new Product();
            $product->product_name =  $data['product_name'];
            $product->product_original_price =  $data['product_original_price'];
            $product->product_price =  $data['product_price'];
            $product->product_keywords =  $data['product_keywords'];
            $product->product_desc =  $data['product_desc'];
            $product->product_quantity =  $data['product_quantity'];
            $product->product_tags =  $data['product_tags'];
            $product->category_id =  $data['category_id'];
            $product->brand_id =  $data['brand_id'];
            $product->product_sold =  0;
            $product->product_status =  $data['product_status'];
            $product->product_content =  $data['product_content'];
            $product->product_image =  $new_image;
           if($data['product_price'] >= $data['product_original_price']){
                $product->save();
                session()->put('message', 'Thêm Sản Phẩm Thành Công!!!');
                return Redirect::to('all-product');
           }else{
                session()->put('message', 'Vui Lòng Thêm Hình Ảnh Thương Hiệu!!!');
                return redirect()->back()->with('message', 'Giá Bán Phải Lớn Hoặc Bằng Giá Nhập!!!');
           }
        }else{
            session()->put('message', 'Vui Lòng Thêm Hình Ảnh Thương Hiệu!!!');
            return redirect()->back()->with('message', 'Vui Lòng Thêm Ảnh Sản Phẩm');
        }
        
    }

    public function unactive_product($product_id){
        $this->AuthenLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        session()->put('message', 'Kích Hoạt Sản Phẩm Thành Công!!!');
        return Redirect::to('all-product');
    }

    public function active_product($product_id){
        $this->AuthenLogin();
        DB::table('tbl_product')->where('brand_id', $product_id)->update(['product_status' => 0]);
        session()->put('message', 'Khóa Sản Phẩm Thành Công!!!');
        return Redirect::to('all-product');
    }
    
    public function edit_product($product_id){
        $this->AuthenLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.product.edit_product')->with('edit_product', $edit_product)
        ->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.product.edit_product', $manager_product);
    }

    public function update_product(Request $request,$product_id){
        $this->AuthenLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_original_price'] = $request->product_original_price;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_desc'] = $request->product_desc;
        $data['product_tags'] = $request->product_tags;
        $data['product_content'] = $request->product_content;
        $data['product_keywords'] = $request->product_keywords;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            Product::where('product_id', $product_id)->update($data);
            session()->put('message', 'Cập Nhật Sản Phẩm Thành Công!!!');
            return Redirect::to('all-product');
        }
        else if($data['product_price'] >= $data['product_original_price']){
            Product::where('product_id', $product_id)->update($data);
            session()->put('message', 'Cập Nhật Sản Phẩm Thành Công!!!');
            return Redirect::to('all-product');
        }else{
            return redirect()->back()->with('message', 'Giá Bán Phải Lớn Hoặc Bằng Giá Nhập!!!');
        }
    }

    public function delete_product($product_id){
        $this->AuthenLogin();
        Product::where('product_id', $product_id)->delete();
        session()->put('message', 'Xóa Sản Phẩm Thành Công!!!');
        return Redirect::to('all-product');
    }

    // end Admin-product

    public function details_product(Request $request,$product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','desc')->get();
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id', $product_id)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }

        foreach($details_product as $key => $pro){
            $product_id = $pro->product_id;
            $product_cate = $pro->category_name;
            $cate_slug = $pro->category_id;
            $meta_desc = $pro->product_desc;
            $meta_keywords = $pro->product_keywords;
            $meta_title = $pro->product_name;
            $url_canonical = $request->url();
        }

        //gallery
        $gallery = Gallery::where('product_id', $product_id)->get();

        $comment_count = Comment::where('comment_product_id', $product_id)->count();
        // echo $comment_count;

        $rating = Rating::where('product_id', $product_id)->avg('rating');
        $rating = round($rating);
        
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->orderby(DB::raw('RAND()'))->paginate(3);

        return view('pages.sanpham.show_details')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('gallery', $gallery)
        ->with('rating', $rating)
        ->with('comment_count', $comment_count)
        ->with('product_details', $details_product)
        ->with('relate', $related_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical)
        ->with('product_cate', $product_cate)
        ->with('cate_slug', $cate_slug);
    }

    public function tag(Request $request, $product_tag){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','desc')->get();
        $tag = str_replace("-"," ", $product_tag);
        $pro_tag = Product::where('product_status', '1')->where('product_name', 'LIKE', '%'.$tag.'%')->paginate(6);

        // $details_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->where('tbl_product.product_id', $product_id)->get();

        // foreach($details_product as $key => $value){
        //     $category_id = $value->category_id;
        // }

        // foreach($details_product as $key => $pro){
        //     $product_id = $pro->product_id;
            $meta_desc = 'Tags Tìm Kiếm'.$product_tag;
            $meta_keywords = 'Tags Tìm Kiếm'.$product_tag;
            $meta_title = 'Tags Tìm Kiếm'.$product_tag;
            $url_canonical = $request->url();
        // }
        return view('pages.sanpham.tag')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical)
        ->with('product_tag', $product_tag)
        ->with('pro_tag', $pro_tag);
    }

    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->get();
        $output = '';
        foreach($comment as $key => $val){
            $output .='
            <div class="row style_comments">
                <div class="col-md-1">
                    <img width="60" src="'.url('/public/frontend/images/user.png').'" alt="user" class="img img-responsive img-thumbnail">
                </div>
                <div class="col-md-11">
                    <p style="font-size: 1.4rem;">'.$val->comment_name.'</p>
                    <p style="font-size: 1.4rem;">'.$val->comment_date.'</p>
                    <p style="font-size: 1.6rem; font-weight: 500;">'.$val->comment.'</p>
                </div>
            </div><p></p>';
        }
        echo $output;
    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->save();
    }

    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }
}
