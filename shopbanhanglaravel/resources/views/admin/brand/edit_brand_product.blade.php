@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập Nhật Thương Hiệu Sản Phẩm
                        </header>
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
                                @foreach($edit_brand_product as $key => $edit_value)
                                <form role="form" action="{{URL::to('/update-brand-product/' .$edit_value->brand_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên Thương Hiệu Sản Phẩm</label>
                                        <input type="text" value="{{$edit_value->brand_name}}" name="brand_product_name" class="form-control" 
                                        id="exampleInputEmail1" placeholder="Tên Danh Mục...">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình Ảnh Thương Hiệu Sản Phẩm</label>
                                        <input type="file" name="brand_product_image" class="form-control image-preview" 
                                        id="exampleInputEmail1" onchange="previewFile(this);">
                                        <img id="previewImg" src="{{URL::to('public/uploads/brand/'.$edit_value->brand_product_image)}}" width="20%" alt="img">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô Tả Danh Mục Sản Phẩm</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="brand_edit_ckeditor" placeholder="Nhập Mô Tả Danh Mục...">{{$edit_value->brand_desc}}</textarea>
                                    </div>
                                    <!-- <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng Thái</label>
                                        <select name="brand_product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Khóa</option>
                                            <option value="1">Kích hoạt</option>
                                        </select>
                                    </div> -->
                                    <button type="submit" name="update_brand_product" class="btn btn-info">Cập Nhật</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>  
@endsection