@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập Nhật Thông Tin
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
                               
                                <form action="">
                                    {{csrf_field() }}
                                <div class="form-group change_pass" style="position: relative;">
                                    <label for="exampleInputEmail1">Mật Khẩu Cũ</label>
                                    <input type="password" name="password_old" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Mật Khẩu Cũ...">
                                    <a href="javascript::void(0)" style="position: absolute; top: 54%; right: 10px; color: #333;"><i class="fa fa-eye"></i></a>
                                </div>
                                <div class="form-group change_pass" style="position: relative;">
                                    <label for="exampleInputEmail1">Mật Khẩu Mới</label>
                                    <input type="password" name="new_password" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Mật Khẩu Mới...">
                                    <a href="javascript::void(0)" style="position: absolute; top: 54%; right: 10px; color: #333;"><i class="fa fa-eye"></i></a>
                                </div>
                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập Nhật</button>
                            </form>
                            </div>
                           
                        </div>
                    </section>

            </div>  
@endsection