@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
				  <li class="active">Giỏ Hàng</li>
				</ol>
			</div>
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
					</div>
					<div class="col-sm-12">
						<div class="bill-to">
							<p style="color: #333; font-weight: 600; font-size: 2.15rem;">Thông tin gửi hàng</p>
							<div class="form-group">
								<form method="POST">
								@csrf
									<div class="form-group" style="width: 450px;">
										<input class="form-control shipping_email" name="shipping_email" id="exampleInputEmail1" type="text" placeholder="Email" required>
									</div>
									<div class="form-group" style="width: 450px;">
										<input class="form-control shipping_name" name="shipping_name" id="exampleInputEmail1" type="text" placeholder="Họ Và Tên" required>
									</div>
									<div class="form-group" style="width: 450px;">
										<input class="form-control shipping_phone" name="shipping_phone" id="exampleInputEmail1" type="text" placeholder="Số Điện Thoại" required>
									</div>
									<div class="form-group" style="width: 450px;">
										<input class="form-control shipping_address" name="shipping_address" id="exampleInputEmail1" type="text" placeholder="Địa Chỉ" required>
									</div>
									<textarea class="form-control rounded-0 shipping_notes" name="shipping_notes" style="width: 750px;" placeholder="Ghi chú" id="exampleFormControlTextarea1" rows="10"></textarea>
									@if(session()->get('coupon'))
										@foreach(session()->get('coupon') as $key => $cou)
											<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
										@endforeach
									@else
										<input type="hidden" name="order_coupon" class="order_coupon" value="0">
									@endif
									<div>
										<div class="form-group">
											<label for="exampleInputPassword1" style="font-size: 1.2rem; margin-top: 10px;">Chọn Hình Thức Thanh Toán</label>
											<select name="shipping_method" class="form-control input-sm m-bot15 shipping_method" style="width: 400px;">
												<option value="0">Thanh Toán Trực Tuyến</option>
												<option value="1">Thanh Toán Khi Nhận Hàng</option>
											</select>
										</div>
									</div>
									<input class="btn btn-primary send_order" 
									style="
									font-size: 1.8rem; 
									width: 350px; 
									height: 40px; 
									border-radius: 25px" 
									type="button" value="Gửi Thông Tin Đặt Hàng" name="send_order">
								</form>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
</section> <!--/#cart_items-->
@endsection