@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
      Danh Sách Mã Giảm Giá
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
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
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Tên Mã Giảm</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Ngày Bắt Đầu</th> 
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Ngày Kết Thúc</th> 
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Mã Giảm Giá</th> 
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Số Lượng Mã</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Điều Kiện Giảm</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Tỷ Lệ Giảm</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Trạng Thái</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Tình Trạng</th>
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $cou)
          <tr>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$cou->coupon_name}}</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$cou->coupon_date_start}}</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$cou->coupon_date_end}}</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$cou->coupon_code}}</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$cou->coupon_time}}</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;"><span class="text-ellipsis">
              <?php
                if($cou->coupon_condition == 1){
                  ?>
                    Giảm Theo %
                <?php 
                }else{
                  ?>
                  Giảm Theo Tiền
              <?php 
                }
              ?>
            </span></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;"><span class="text-ellipsis">
              <?php
                if($cou->coupon_condition == 1){
                  ?>
                    Giảm {{$cou->coupon_number}} %
                <?php 
                }else{
                  ?>
                  Giảm {{$cou->coupon_number}}đ
              <?php 
                }
              ?>
            </span></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;"><span class="text-ellipsis">
              <?php
                if($cou->coupon_status == 1 && $cou->coupon_date_end >= $today && $cou->coupon_time > 0){
                  ?>
                    <span class="text-success">Kích Hoạt</span>
                <?php 
                }else{
                  ?>
                  <span class="text-danger">Khóa</span>
              <?php 
                }
              ?>
            </span></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;"><span class="text-ellipsis">
            <?php
                if($cou->coupon_date_end >= $today && $cou->coupon_time > 0){
                  ?>
                    <span class="text-success">Kích Hoạt</span>
                <?php 
                }else{
                  ?>
                  <span class="text-danger">Mã Hết Hạn / Hết Mã</span>
              <?php 
                }
              ?>  
            </td>
            <td>
              <a onclick="return confirm('Xác nhận xóa mã giảm giá ?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa-solid fa-trash text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection