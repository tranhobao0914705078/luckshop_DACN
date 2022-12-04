@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
                            Thêm Mã Giảm Giá
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
                                <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Mã Giảm Giá</label>
                                    <input type="text" name="coupon_name" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Tên Mã Giảm Giá..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày Bắt Đầu</label>
                                    <input type="text" name="coupon_date_start" class="form-control" 
                                    id="start_coupon" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày Kết Thúc</label>
                                    <input type="text" name="coupon_date_end" class="form-control" 
                                    id="end_coupon" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã Giảm Giá</label>
                                    <input type="text" name="coupon_code" class="form-control" 
                                    id="exampleInputEmail1" placeholder="Mã Giảm Giá..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số Lượng Mã</label>
                                    <input type="number" min= 1 name="coupon_time" class="form-control" 
                                        id="exampleInputEmail1" placeholder="Số Lượng Mã..." required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tính Năng Mã Giảm Giá</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="0">----Chọn----</option>
                                        <option value="1">Giảm Theo Phần Trăm</option>
                                        <option value="2">Giảm Theo Tiền</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập Số Phần % Hoặc Số Tiền Giảm</label>
                                    <input type="text" name="coupon_number" class="form-control" 
                                        id="exampleInputEmail1" placeholder="Nhập Mã Giảm..." required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                    <select name="coupon_status" class="form-control input-sm m-bot15">
                                        <option value="0">Khóa</option>
                                        <option value="1">Kích hoạt</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_coupon" class="btn btn-info">Thêm Mã</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>  
@endsection