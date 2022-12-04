@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
      Đơn Đặt Hàng
    </div>
    <div class="row w3-res-tb">
      
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
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">STT</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Mã Đơn Hàng</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Ngày Đặt</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Tình Trạng</th> 
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Lý Do Hủy</th> 
            <th style="font-size: 1rem; font-weight: 600; color: gray;"></th> 
          </tr>
        </thead>
        <tbody>
          <?php
             $i = 0;
          ?>
          @foreach($order as $key => $ord)
          <?php
            $i++; 
          ?>
          <tr>
            <td><i>{{$i}}</i></label></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$ord->order_code}}</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$ord->created_at}}</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">
              @if($ord->order_status==1)
                <p><b>Đơn Hàng Mới - Chưa Xử Lý</b></p>
              @elseif($ord->order_status==2)
                <p class="text-success"><b>Đã Xác Nhận - Vận Chuyển</b></p>
              @else
                <p class="text-danger"><b>Đơn Hàng Đã Hủy</b></p>
              @endif
            </td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$ord->order_destroy}}</td>
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa-solid fa-eye text-success text-active"></i>
              </a>
              <!-- <a onclick="return confirm('Xác nhận xóa danh mục sản phẩm này?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa-solid fa-trash text-danger text"></i>
              </a> -->
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection