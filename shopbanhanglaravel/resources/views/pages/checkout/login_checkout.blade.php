@extends('layout')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1">
					@if(session()->has('message'))
					<div class="alert alert-success title_user">
						{!!session()->get('message')!!}
					</div>
					@elseif(session()->has('error'))
						<div class="alert alert-danger" style="display: none;">
							{!!session()->get('error')!!}
						</div>
					@endif
					<div class="login-form"><!--login form-->
						<h2>Đăng Nhập</h2>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{csrf_field() }}
							<input type="text" name="email_account" placeholder="Tài Khoản" />
							<div class="change_pass">
								<input type="password" name="password_account" placeholder="Mật Khẩu" />
								<a href="javascript::void(0)" style="position: absolute; top: 53%; right: 22px; color: #333;"><i class="fa fa-eye"></i></a>
							</div>
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ
							</span>
							<span>
								<a href="{{URL::to('/forgetPassword')}}">Quên Mật Khẩu</a>
							</span>
							<button type="submit" class="btn btn-default">Đăng Nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-3">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng Ký</h2>
						<form action="{{URL::to('/add-customer')}}" method="POST">
                            {{csrf_field() }}
							<input type="text" name="customer_name" placeholder="Tên"/>
							<input type="email" name="customer_email" placeholder="Email"/>
							<div class="change_pass">
								<input type="password" name="customer_password" placeholder="Mật Khẩu"/>
								<a href="javascript::void(0)" style="position: absolute; top: 53%; right: 22px; color: #333;"><i class="fa fa-eye"></i></a>
								<span class="form-text small text-muted">   
									Mật khẩu phải có 8-20 ký tự và phải <em>không</em> chứa khoảng trắng.
								</span>
							</div>
                            <input type="text" name="customer_phone" placeholder="Phone"/>
							<button type="submit" class="btn btn-default">Đăng Ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
</section><!--/form-->
@endsection