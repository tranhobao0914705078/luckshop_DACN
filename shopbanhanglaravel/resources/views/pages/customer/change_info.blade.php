@extends('layout')
@section('content')
<section style="background-color: #eee;">
  <div class="container py-5">
    <!-- <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div> -->
    <div class="row">
      <div class="col-lg-4" style="margin: 10px 0;">
      </div>
      <div class="col-lg-8" style="margin: 86px -160px; width: 470px; border-radius: 10px;">
        <div class="card mb-4">
          <div class="card-body">
            <!-- form card change password -->
            <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0" style="font-size: 2.4rem; font-weight: bold;">Cập Nhật Thông Tin</h3>
                        </div>
                        <div class="card-body">
                            @foreach($customer as $key => $cus)
                            <form class="form" action="{{URL::to('/update-profile-user/' .$cus->customer_id)}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="inputPasswordOld">Họ Và Tên</label>
                                    <input type="text" class="form-control" name="customer_name" id="inputPasswordOld" required="" value="{{$cus->customer_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNew">Email</label>
                                    <input type="email" class="form-control" name="customer_email" id="inputPasswordNew" required="" value="{{$cus->customer_email}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNewVerify">Số Điện Thoại</label>
                                    <input type="number" class="form-control" name="customer_phone" id="inputPasswordNewVerify" required="" value="{{$cus->customer_phone}}">
                                </div>
                                <div class="form-group">
                                   
                                    <input type="hidden" class="form-control" name="customer_password" id="inputPasswordNewVerify" required="" value="{{$cus->customer_password}}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg float-right">Cập Nhật Thông Tin</button>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                    <!-- /form card change password -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
</section>
@endsection