@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
                            Thêm Banner
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
                                <form role="form" action="{{URL::to('/insert-slider')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Banner</label>
                                    <input type="text" name="slider_name" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tên Banner..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh</label>
                                    <input type="file" name="slider_image" class="form-control" 
                                    id="exampleInputEmail1" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả</label>
                                    <textarea style="resize: none" rows="8" class="form-control" id="slider_ckeditor" name="slider_desc" placeholder="Nhập Mô Tả Banner..." required></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                    <select name="slider_status" class="form-control input-sm m-bot15">
                                        <option value="0">Khóa</option>
                                        <option value="1">Kích hoạt</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm Banner</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>  
@endsection