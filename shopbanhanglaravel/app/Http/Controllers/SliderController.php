<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
session_start();

class SliderController extends Controller
{
    public function AuthenLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function manage_slider(){
        $all_slide = Slider::orderBy('slider_id', 'DESC')->get();
        return view('admin.slider.list_slide')->with(compact('all_slide'));
    }

    public function add_slider(){
        return view('admin.slider.add_slide');
    }

    public function insert_slider(Request $request){
        $data = $request->all();
        $this->AuthenLogin();
        $get_image = $request->file('slider_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider', $new_image);
            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $data['slider_image'];
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save();
            session()->put('message', 'Thêm Banner Thành Công!!!');
            return Redirect::to('manage-slider');
        }else{
            session()->put('message', 'Vui Lòng Thêm Hình Ảnh Banner!!!');
            return Redirect::to('all-product');
        }
    }

    public function unactive_slide($slider_id){
        $this->AuthenLogin();
        DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status' => 1]);
        session()->put('message', 'Kích Hoạt Banner Thành Công!!!');
        return Redirect::to('manage-slider');
    }

    public function active_brand_product($slider_id){
        $this->AuthenLogin();
        DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status' => 0]);
        session()->put('message', 'Khóa Banner Thành Công!!!');
        return Redirect::to('manage-slider');
    }

    public function delete_slide($slider_id){
        $this->AuthenLogin();
        DB::table('tbl_slider')->where('slider_id', $slider_id)->delete();
        session()->put('message', 'Xóa Banner Thành Công!!!');
        return Redirect::to('manage-slider');
    }
}
