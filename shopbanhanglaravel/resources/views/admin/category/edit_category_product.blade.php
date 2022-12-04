@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
                        Cập Nhật Danh Mục Sản Phẩm
                    </div>
                        <div class="panel-body">
                        <!-- <?php
                            use Illuminate\Contracts\Session\Session;
                            $message = session()->get('message');
                            if($message){
                                echo '<span class="text-success">',$message,'</span>';
                                session()->put('message', null);
                            }
                        ?> -->
                            <div class="position-center">
                                @foreach($edit_category_product as $key => $edit_value)
                                <form role="form" action="{{URL::to('/update-category-product/' .$edit_value->category_id)}}" method="post" onsubmit="createTextSnippet();">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục Sản Phẩm</label>
                                    <input type="text" value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tên Danh Mục...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$edit_value->slug_category_product}}" name="slug_category_product" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Slug...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Danh Mục Sản Phẩm</label>
                                    <textarea style="resize: none" rows="8" id="cate_edit_ckeditor" class="form-control" name="category_product_desc" placeholder="Nhập Mô Tả Danh Mục...">{{$edit_value->category_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ Khóa Danh Mục Sản Phẩm</label>
                                    <textarea style="resize: none" rows="8" id="cate_edit_ckeditor1" class="form-control" name="category_product_keywords" placeholder="Nhập Mô Tả Danh Mục...">{{$edit_value->meta_keywords}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày Thêm Danh Mục</label>
                                    <input type="text" disabled value="{{$edit_value->created_at}}" name="category_created_at" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Được Cập Nhật Vào Ngày</label>
                                    <input type="text" disabled value="{{$edit_value->updated_at}}" class="form-control" id="exampleInputEmail1">
                                </div>
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập Nhật</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>  
@endsection