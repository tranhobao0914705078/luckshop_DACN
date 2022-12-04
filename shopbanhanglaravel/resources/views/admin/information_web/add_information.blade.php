@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
                            Thông Tin Web
                        </header>
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
                        <div class="panel-body">
                            <div class="position-center">
                            @foreach($contact as $key => $val)
                                <form role="form" action="{{URL::to('/update-info/'.$val->info_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thông Tin Liên Hệ</label>
                                        <textarea style="resize: none" rows="8" class="form-control" id="contact_ckeditor1" name="info_contact" required>{{$val->info_contact}}</textarea>
                                    </div>  
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thông Tin Bản Đồ</label>
                                        <textarea style="resize: none" rows="8" class="form-control" id="contact_ckeditor2" name="info_map" required>{{$val->info_map}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thông Tin Fanpages</label>
                                        <textarea style="resize: none" rows="8" class="form-control" id="contact_ckeditor3" name="info_fanpage" required>{{$val->info_fanpage}}</textarea>
                                    </div>
                                    <button type="submit" name="add_brand_product" class="btn btn-info">Cập Nhật Thông Tin</button>
                                </form>
                            @endforeach
                            </div>
                        </div>
                    </section>

            </div>  
@endsection