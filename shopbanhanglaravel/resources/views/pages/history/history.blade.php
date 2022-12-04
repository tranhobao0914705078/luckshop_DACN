@extends('layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
      Danh Sách Đơn Đặt Hàng
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
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">STT</th>
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Mã Đơn Hàng</th>
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Ngày Đặt</th>
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;">Tình Trạng</th> 
            <th style="font-size: 1.4rem; font-weight: 600; color: gray;"></th> 
          </tr>
        </thead>
        <tbody>
          <?php
             $i = 0;
          ?>
          @foreach($getorder as $key => $ord)
          <?php
            $i++; 
          ?>
            <tr>
            <td><i>{{$i}}</i></label></td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{$ord->order_code}}</td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">{{$ord->created_at}}</td>
            <td style="font-size: 1.4rem; font-weight: 600; color: #000;">
              @if($ord->order_status==1)
                <p><b>Đơn Hàng Mới - Chưa Xử Lý</b></p>
              @elseif($ord->order_status==2)
                <p class="text-success"><b>Đã Xác Nhận - Vận Chuyển</b></p>
              @else
                <p class="text-danger"><b>Đơn Hàng Hủy</b></p>
              @endif
            </td>
            <td>
              <a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" class="active styling-edit btn btn-secondary" ui-toggle-class="">
                Xem Đơn Hàng
              </a>
              @if($ord->order_status != 3 && $ord->order_status != 2)
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelOrder">Hủy Đơn Hàng</button>
              @endif
              <div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form>
                    @csrf
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lý Do Hủy Đơn Hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><textarea class="reasonCancel" rows="5" require placeholder="Lý Do Hủy..."></textarea></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" id="{{$ord->order_code}}" onclick="CancelOrderCustomer(this.id)" class="btn btn-success">Gửi Lý Do</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- <a onclick="return confirm('Xác nhận xóa danh mục sản phẩm này?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa-solid fa-trash text-danger text"></i>
              </a> -->
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
        <div class="row">
            <div class="col-sm-5 text-center">
                <ul class="pagination pagination-sm m-t-none m-b-none">
                    {{$getorder->links()}}
                </ul>
            </div>
        </div>
    </footer>
  </div>
</div>
@endsection