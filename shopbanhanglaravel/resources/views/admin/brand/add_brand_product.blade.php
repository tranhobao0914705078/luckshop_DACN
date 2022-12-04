@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
                            Thêm Thương Hiệu Sản Phẩm
                        </header>
                        <div class="panel-body">
                        <?php
                            $message = session()->get('message');
                            if($message){
                                echo '<span class="text-success">',$message,'</span>';
                                session()->put('message', null);
                            }
                        ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Thương Hiệu Sản Phẩm</label>
                                    <input type="text" name="brand_product_name" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tên Thương Hiệu Mục..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh Thương Hiệu</label>
                                    <input type="file" name="brand_product_image" class="form-control image-preview" 
                                    id="exampleInputEmail1" required onchange="previewFile(this);">
                                    <img src="https://inantemnhan.com.vn/wp-content/uploads/2017/10/no-image.png" alt="picture" id="previewImg" width="30%">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Thương Hiệu Sản Phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="brand_ckeditor" placeholder="Nhập Mô Tả Danh Mục..." required></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                    <select name="brand_product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Khóa</option>
                                        <option value="1">Kích hoạt</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm Thương Hiệu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>  
@endsection