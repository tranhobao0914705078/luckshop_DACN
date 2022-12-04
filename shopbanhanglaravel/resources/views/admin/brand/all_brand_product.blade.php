@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
      Danh Sách Thương Hiệu
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
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Tên Thương Hiệu</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Hình Ảnh</th> 
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Mô Tả</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Trạng Thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_brand_product as $key => $brand_pro)
          <tr>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$brand_pro->brand_name}}</td>
            <td><img src="public/uploads/brand/{{$brand_pro->brand_product_image}}" height="80" width="120" alt="img"></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$brand_pro->brand_desc}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($brand_pro->brand_status == 0){
                  ?>
                <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}" 
                    style="font-size: 1rem; font-weight: 600; cursor: pointer; text-decoration: none" class="text-danger">Khóa <i class="fa-solid fa-eye-slash"></i></a>
                <?php 
                }else{
                  ?>
                  <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}" 
                  style="font-size: 1rem; font-weight: 600; cursor: pointer; text-decoration: none" class="text-success">Kích hoạt <i class="fa-solid fa-eye"></i></a>
              <?php 
                }
              ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa-solid fa-pen-to-square text-success text-active"></i>
              </a>
              <a onclick="return confirm('Xác nhận xóa danh mục sản phẩm này?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa-solid fa-trash text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
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
      </div>
    </footer>
  </div>
</div>
@endsection