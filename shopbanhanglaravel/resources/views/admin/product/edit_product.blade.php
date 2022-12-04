@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
                            Cập Nhật Sản Phẩm
                        </header>
                        <div class="panel-body">
                        <?php
                            use Illuminate\Contracts\Session\Session;
                            $message = session()->get('message');
                            if($message){
                                echo '<span class="text-success">',$message,'</span>';
                                session()->put('message', null);
                            }
                        ?>
                            <div class="position-center">
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" name="product_name" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tên Sản Phẩm..." value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Nhập Sản Phẩm</label>
                                    <input type="number" name="product_original_price" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Giá nhập Sản Phẩm..." value="{{$pro->product_original_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                    <input type="number" name="product_price" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Giá Sản Phẩm..." value="{{$pro->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số Lượng</label>
                                    <input type="number" name="product_quantity" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Giá Sản Phẩm..." value="{{$pro->product_quantity}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                    <input type="file" name="product_image" class="form-control image-preview" 
                                    id="exampleInputEmail1" onchange="previewFile(this);">
                                    <img id="previewImg" src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" width="20%" alt="img">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="pro_edit_ckeditor" placeholder="Nhập Mô Tả Danh Mục...">{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="pro_edit_ckeditor1" placeholder="Nhập Mô Tả Danh Mục...">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tags Sản Phẩm</label>
                                    <input type="text" data-role="tagsinput" name="product_tags" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tags Sản Phẩm..." value="{{$pro->product_tags}}" require>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ Khóa Sản Phẩm</label>
                                    <input type="text" name="product_keywords" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tên Sản Phẩm..." value="{{$pro->product_keywords}}">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                                    <select name="category_id" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->category_id==$pro->category_id)
                                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @else
                                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Thương Hiệu</label>
                                    <select name="brand_id" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            @if($cate->category_id==$pro->category_id)
                                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @else
                                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Khóa</option>
                                        <option value="1">Kích hoạt</option>
                                    </select>
                                </div> -->
                                <button type="submit" name="update_product" class="btn btn-info">Cập Nhật Sản Phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>  
@endsection