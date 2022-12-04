@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
      Danh Sách Banner
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4">
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
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Tên Banner</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Hình Ảnh</th> 
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Mô Tả</th>
            <th style="font-size: 1rem; font-weight: 600; color: gray;">Trạng Thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_slide as $key => $slide)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$slide->slider_name}}</td>
            <td><img src="public/uploads/slider/{{$slide->slider_image}}" height="100" width="100" alt="img"></td>
            <td style="font-size: 1rem; font-weight: 600; color: #000;">{{$slide->slider_desc}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($slide->slider_status == 0){
                  ?>
                <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}" 
                    style="font-size: 1rem; font-weight: 600; cursor: pointer; text-decoration: none" class="text-danger">Khóa <i class="fa-solid fa-eye-slash"></i></a>
                <?php 
                }else{
                  ?>
                  <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}" 
                  style="font-size: 1rem; font-weight: 600; cursor: pointer; text-decoration: none" class="text-success">Kích hoạt <i class="fa-solid fa-eye"></i></a>
              <?php 
                }
              ?>
            </span></td>
            <td>
              <a onclick="return confirm('Xác nhận xóa banner này?')" href="{{URL::to('/delete-slide/'.$slide->slider_id)}}" class="active styling-edit" ui-toggle-class="">
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