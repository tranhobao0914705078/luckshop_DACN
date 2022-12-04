@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
      Danh Sách Sản Phẩm
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
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Tên Sản Phẩm</th> 
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Hình ảnh</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Giá Nhập</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Giá Bán</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Danh Mục</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Thư Viện Ảnh</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Số Lượng</th> 
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Thương Hiệu</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Trạng Thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php
             $i = 0;
          ?>
          @foreach($all_product as $key => $pro)
          <?php
            $i++; 
          ?>
          <tr>
            <td><i>{{$i}}</i></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$pro->product_name}}</td>
            <td><img src="public/uploads/product/{{$pro->product_image}}" height="100" width="100" alt="img"></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{number_format($pro->product_original_price,0,',','.')}} đ</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{number_format($pro->product_price,0,',','.')}} đ</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$pro->category_name}}</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;"><a href="{{url('/add-gallery/'.$pro->product_id)}}">Thêm Chi Tiết Ảnh</a></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$pro->product_quantity}}</td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$pro->brand_name}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($pro->product_status == 0){
                  ?>
                  <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}" 
                  style="font-size: 1rem; font-weight: 600; cursor: pointer; text-decoration: none" class="text-danger">Khóa 
                  <i class="fa-solid fa-eye-slash"></i>
                </a>
                <?php 
                }else{
                  ?>
                  <a href="{{URL::to('/active-product/'.$pro->product_id)}}" 
                  style="font-size: 1rem; font-weight: 600; cursor: pointer; text-decoration: none" class="text-success">Kích hoạt 
                  <i class="fa-solid fa-eye"></i>
                </a>
              <?php 
                }
              ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa-solid fa-pen-to-square text-success text-active"></i>
              </a>
              <a onclick="return confirm('Xác nhận xóa sản phẩm này?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa-solid fa-trash text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <!-- <div class="row">
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div> -->
    </footer>
  </div>
</div>
@endsection