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

class GalleryController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect('/dashboard');
        }else{
            return Redirect('/admin')->send();
        }
    }

    public function add_gallery($product_id){
        $pro_id = $product_id;
        return view('admin.gallery.add_gallery')->with(compact('pro_id'));
    }

    public function select_gallery(Request $request){
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '<form>
        '.csrf_field().'
        <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mô Tả Ảnh</th>
                    <th scope="col">Hình Ảnh</th>
                
                    </tr>
                </thead>
            <tbody>
            ';
        if($gallery_count > 0){
            $i = 0;
            foreach($gallery as $key => $val){
                $i++;
                $output .= '
                    <tr>
                        <td><i>'.$i.'</i></td>
                        <td contenteditable class="edit_gal_name" data-gal_id="'.$val->gallery_id.'">'.$val->gallery_name.'</td>
                        <td><img width = 100 src="'.url('public/uploads/gallery/'.$val->gallery_image).'"></td>
                    </tr>
               
                ';
            }
        }else{
            $output .= '
                <tr>
                    <td colspan="4">Không Có Thư Viện Ảnh!!!</td>
                </tr>
            ';
        }
        $output .= '
            </tbody>
            </table>
            </form>
        ';
        echo $output;
    }
    
    public function insert_gallery($pro_id, Request $request){
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/gallery', $new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
            }
        }
        session()->put('message', 'Thêm Thư Viện Ảnh Thành Công!!!');
        return Redirect()->back();
    }

    public function update_gallery_name(Request $request){
        $galllery_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($galllery_id);
        $gallery->gallery_name = $gal_text;
        $gallery->update($gallery->gallery_name);
    }

    public function delete_gallery(Request $request){
        $galllery_id = $request->gal_id;
        $gallery = Gallery::find($galllery_id);
        unlink('public/uploads/gallery/' .$gallery->gallery_image);
        $gallery->delete();
    }
}
