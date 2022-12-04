<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart; 
session_start();
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact(Request $request){
        $meta_desc = "Liên Hệ Với Chúng Tôi";
        $meta_keywords = "Contact";
        $meta_title = "Liên Hệ Với Chúng Tôi";
        $url_canonical = $request->url();
        //End Seo
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id','desc')->get();
        $contact = Contact::where('info_id', 2)->get();
        return view('pages.contact.contact')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('contact', $contact)
        ->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function information(){
        $contact = Contact::where('info_id', 2)->get();
        return view('admin.information_web.add_information')->with(compact('contact'));
    }

    public function save_info(Request $request){
        $data = $request->all();
        $contact = new Contact();
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
        $contact->info_fanpage = $data['info_fanpage'];
        $contact->save();
        return redirect()->back()->with('message', 'Cập Nhật Thành Công');
    }

    public function update_info($info_id, Request $request){
        $data = $request->all();
        $contact = Contact::find($info_id);
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
        $contact->info_fanpage = $data['info_fanpage'];
        $contact->save();
        return redirect()->back()->with('message', 'Cập Nhật Thành Công');
    }
}
