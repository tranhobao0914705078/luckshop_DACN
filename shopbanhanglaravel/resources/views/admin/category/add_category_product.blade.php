@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
                            Thêm Danh Mục Sản Phẩm
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục Sản Phẩm</label>
                                    <input type="text" name="category_product_name" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tên Danh Mục..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="slug_category_product" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Slug..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Danh Mục Sản Phẩm</label>
                                    <textarea style="resize: none" rows="8" required class="form-control" name="category_product_desc" id="cate_ckeditor" placeholder="Nhập Mô Tả Danh Mục..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ Khóa Danh Mục Sản Phẩm</label>
                                    <textarea style="resize: none" rows="8" required class="form-control" name="category_product_keywords" id="cate_ckeditor1" placeholder="Nhập Mô Tả Danh Mục..."></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                    <select name="category_product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Khóa</option>
                                        <option value="1">Kích hoạt</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm Danh Mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>  
@endsection