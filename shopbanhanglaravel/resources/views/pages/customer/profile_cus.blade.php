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
    @if(session()->has('message'))
                <div class="alert alert-success title_user" style="margin: 10px 0; width: 832px;">
                    {!!session()->get('message')!!}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger" style="display: none;">
                    {!!session()->get('error')!!}
                </div>
    @endif
    <div class="row">
      <div class="col-lg-4" style="margin: 10px 0;">
        <div class="card mb-4">
          <div class="card-body text-center">
          <img class="rounded-circle shadow-1-strong me-3"src="{{asset('public/frontend/images/user.png')}}" alt="avatar" width="40"height="40" />
            @foreach($customer as $key => $cus)
                <h5 class="my-3">{{$cus->customer_name}}</h5>
            @endforeach
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning"></i>
                <a class="mb-0 contact-social" href="http://localhost/shopbanhanglaravel/trang-chu"><p class="mb-0" style="color: #000;">localhost/shopbanhanglaravel</p></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <a class="mb-0 contact-social" target="_blank" href="https://github.com/tranhobao0914705078"><p class="mb-0" style="color: #000;">github.com/tranhobao0914705078</p></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <a class="mb-0 contact-social" target="_blank" href="https://www.instagram.com/tranhob/"><p class="mb-0" style="color: #000;">tranhob</p></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <a class="mb-0 contact-social" target="_blank" href="https://www.instagram.com/tranhob/"><p class="mb-0" style="color: #000;">tranhob</p></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <a class="mb-0 contact-social" target="_blank" href="https://www.facebook.com/bao.tranho.100"><p class="mb-0" style="color: #000;">facebook.com/bao.tranho.100</p></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8" style="margin: 86px 0; width: 470px; border-radius: 10px;">
        <div class="card mb-4">
          <div class="card-body">
          <ul class="list-group list-group-flush rounded-3">
            @foreach($customer as $key => $cus)
              <li class="list-group-item d-flex justify-content-between align-items-center p-3" style="display: flex;">
                <b>Full Name:</b>
                <p class="mb-0" style="margin: 0 10px; color: #000; font-weight: 500;">{{$cus->customer_name}}</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3" style="display: flex;">
                <b>Email:</b>
                <p class="mb-0" style="margin: 0 10px; color: #000; font-weight: 500;"><a href="mailto: @(Model.ContactDetail.Email)">{{$cus->customer_email}}</a></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3" style="display: flex;">
                <b>Phone:</b>
                <p class="mb-0" style="margin: 0 10px; color: #000; font-weight: 500;">{{$cus->customer_phone}}</p>
              </li>
            @endforeach
            </ul>
                <a style="color: #000; font-weight: 500;" class="btn btn-default" href="{{url('/update-profile/'.$cus->customer_id)}}">Cập Nhật Thông Tin</a>
                <a style="color: #000; font-weight: 500;" class="btn btn-default" href="{{url('/change-pass-cus/'.$cus->customer_id)}}">Đổi Mật Khẩu</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
</section>
@endsection