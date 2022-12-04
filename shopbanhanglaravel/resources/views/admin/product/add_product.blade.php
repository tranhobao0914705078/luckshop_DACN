@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
                            Thêm Sản Phẩm
                        </header>
                        <div class="panel-body">
                        <?php
                            use Illuminate\Contracts\Session\Session;
                            $message = session()->get('message');
                            if($message){
                            echo '<div id="toast">
                                    <div class="toast toast--success">
                                            <div class="toast__icon">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div class="toast__body">
                                                <h3 class="toast__title">Thành Công</h3>
                                                <p class="toast__msg">',$message,'</p>
                                            </div> 
                                    </div>
                                </div>';
                            session()->put('message', null);
                            }
                        ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" name="product_name" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tên Sản Phẩm..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Nhập Sản Phẩm</label>
                                    <input type="number" name="product_original_price" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Giá nhập Sản Phẩm...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                    <input type="text" name="product_price" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Giá Sản Phẩm..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số Lượng</label>
                                    <input type="number" name="product_quantity" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Số Lượng Sản Phẩm..." required>
                                </div>
                                <input type="hidden" name="product_sold" class="form-control" id="exampleInputEmail1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                    <input type="file" name="product_image" class="form-control image-preview" 
                                    id="exampleInputEmail1" onchange="previewFile(this);">
                                    <img src="https://inantemnhan.com.vn/wp-content/uploads/2017/10/no-image.png" alt="picture" id="previewImg" width="30%">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                                    <textarea style="resize: none" required rows="8" class="form-control" name="product_desc" id="pro_ckeditor" placeholder="Nhập Mô Tả Danh Mục..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                    <textarea style="resize: none" required rows="8" class="form-control" name="product_content" id="pro_ckeditor1" placeholder="Nhập Mô Tả Danh Mục..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tags Sản Phẩm</label>
                                    <input type="text" data-role="tagsinput" name="product_tags" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tags Sản Phẩm..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ Khóa Sản Phẩm</label>
                                    <input type="text" name="product_keywords" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Từ Khóa..." required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                                    <select name="category_id" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Thương Hiệu</label>
                                    <select name="brand_id" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Khóa</option>
                                        <option value="1">Kích hoạt</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>  
@endsection