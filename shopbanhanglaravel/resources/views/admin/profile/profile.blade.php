@extends('admin_layout')
@section('admin_content')
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
    <div class="panel-heading">
      Thông Tin Users
    </div>
      <div class="col-lg-8 text-center" style="position: relative; margin: 0 285px;">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$admin->admin_name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
              <p class="text-muted mb-0">{{$admin->admin_email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                 <p class="text-muted mb-0">{{$admin->admin_phone}}</p>
              </div>
            </div>
            <hr>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Password</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$admin->admin_password}}</p>
              </div>
            </div>
            <a style="position: relative; left: 300px; top: -30px;" class="btn btn-primary" href="{{url('change-pass')}}">Đổi Mật Khẩu</a> 
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection