@extends('layout')
@section('content')
<!-- TABLE THÔNG TIN KHÁCH HÀNG -->
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
      Thông Tin Khách Hàng
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
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Tên Khách Hàng</th> 
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{$customer->customer_name}}</td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{$customer->customer_email}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- END TABLE THÔNG TIN KHÁCH HÀNG -->
<br></br>
<!-- TABLE VẬN CHUYỂN -->
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
      Thông Tin Vận Chuyển
    </div>
    <div class="table-responsive">
    <?php
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
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Tên Người Nhận</th> 
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Địa Chỉ</th>
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Số Điện Thoại</th>
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Ghi Chú</th>
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Hình Thức Thanh Toán</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{$shipping->shipping_name}}</td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{$shipping->shipping_address}}</td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{$shipping->shipping_phone}}</td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{$shipping->shipping_notes}}</td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">
              @if($shipping->shipping_method == 0)
                Thanh Toán Trực Tuyến
              @else
                Thanh Toán Khi Nhận Hàng
              @endif
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- END TABLE VẬN CHUYỂN -->
<br></br>
<!-- TABLE CTDH -->
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
      Chi Tiết Đơn Hàng
    </div>
    <div class="table-responsive">
    <?php
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
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">STT</th> 
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Tên Sản Phẩm</th>
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Mã Giảm Giá</th> 
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Số Lượng</th>
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Giá</th>
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Tổng Tiền</th>
            
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 0; 
            $total = 0;
          ?>
         @foreach($order_details  as $key => $details)
          <?php
            $i++; 
            $total_order = $details->product_price * $details->product_sales_quantity;
            $total += $total_order;
          ?>
          <tr class="color_qty_{{$details->product_id}}">
            <td><i>{{$i}}</i></td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{$details->product_name}}</td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">
              @if($details->product_coupon != 0)
                {{$details->product_coupon}}
              @else
                Không
              @endif
            </td>
            
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">
              <input type="number" disabled style="width: 80px;" class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" 
                  name="product_sales_quantity">
            </td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{number_format($details->product_price,0,',','.')}} đ</td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{number_format($total_order,0,',','.')}} đ</td>
          </tr>
         @endforeach
        </tbody>
      </table>
      <table>
        <tbody style="margin: 0 10px;">
        <tr>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">
              Tổng tiền: {{number_format($total,0,',','.')}} VNĐ</br>
              <?php
                $total_coupon = 0; 
              ?>
              @if($coupon_condition == 1)
                <?php 
                  $total_after_coupon = ($total * $coupon_number) / 100;
                  echo 'Tổng Giảm: ' .number_format($coupon_number,0,',','.').'%'.'</br>';
                  $total_coupon = $total - $total_after_coupon;
                ?>
              @else
                <?php 
                  echo 'Tổng Giảm: ' .number_format($coupon_number,0,',','.').' VNĐ'.'</br>';
                  $total_coupon = $total - $coupon_number;
                ?>
              @endif
              <?php
                $total_fee = 35000; 
                $total_order_all = $total_coupon + $total_fee;
              ?>
              Phí Ship: {{number_format($total_fee,0,',','.')}} VNĐ</br>
              Tổng Hóa Đơn: {{number_format($total_order_all,0,',','.')}} VNĐ
            </td>
         </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- END TABLE CTDH -->
@endsection