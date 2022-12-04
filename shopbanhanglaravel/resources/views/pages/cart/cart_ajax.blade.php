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
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {!!session()->get('message')!!}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {!!session()->get('error')!!}
                </div>
            @endif
			<?php
				$customer_id = session()->get('customer_id');
				if($customer_id == NULL){
				?>
					<p style="font-size: 1.8rem;">Vui Lòng Đăng Nhập <a style="border-bottom: 1px solid #000;" href="{{URL::to('/login-checkout')}}">Tại Đây </a>Để Sử Dụng Thanh Toán Trực Tuyến Và Đặt Hàng</p>
				<?php
				}else{
				?>
				<?php
				}
				?>
			
			<div class="table-responsive cart_info">
            <form action="{{URL::to('/update-cart')}}" method="POST">
                @csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
                            <td class="description">Tên Sản Phẩm</td>
							<td class="image">Hình Ảnh</td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Thành Tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        @if(session()->get('cart') == true)
                        <?php
                            $total = 0; 
                        ?>
                        @foreach(session()->get('cart') as $key => $cart)
                        <?php
                            $subtotal = $cart['product_price'] * $cart['product_qty']; 
                            $total += $subtotal;
                        ?>
						<tr>
                            <td style="width: 100px;" class="cart_description">
                            <p style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">{{$cart['product_name']}}</p>
							</td>
							<td class="cart_product">
								<a href=""><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="80" alt="{{$cart['product_name']}}" /></a>
							</td>
							<td class="cart_price">
                                <p style="font-size: 1.8rem; font-weight: 700; margin:0 10px;">{{number_format($cart['product_price'],0,',','.')}}đ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
									
									<input class="cart_quantity_" type="number" min= 1 name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">

									
								</div>
							</td>
							<td class="cart_total">
                                <p class="cart_total_price">
                                {{number_format($subtotal,0,',','.')}}đ
                                </p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @endforeach
                        <tr>
                            <td style="width: 100px; "><input type="submit" id="btn_update-cart" value="Cập Nhật Giỏ Hàng" name="update_qty" class="btn btn-default check_out btn-sm"> </td>
                            <td style="margin: 80px 0; width: 100px;"><a id="btn_delete-cart" class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa Giỏ Hàng</a></td>
							<td>
								<?php
								$customer_id = session()->get('customer_id');
								if($customer_id != NULL){
								?>
									<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Tiếp Tục Đặt Hàng</a>
								<?php
								}else{
								?>
									<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Tiếp Tục Đặt Hàng</a>
								<?php
									}
								?>
							</td>
                            <td style="position: relative; left: 180px;">
                                <div style="margin: 0 20px;" class="total_area">
                                    <ul>
                                        <li>Tổng Tiền: <span> {{number_format($total,0,',','.')}} đ</span></li>
										@if(session()->get('coupon'))
                                        <li>
												@foreach(session()->get('coupon') as $key => $cou)
													@if($cou['coupon_condition'] == 1)
														Giảm: <span>{{$cou['coupon_number']}} %</span>
														<p>
															<?php
																$total_coupon = ($total * $cou['coupon_number'])/100; 
																echo '<p><li>Tổng Giảm: <span>'.number_format($total_coupon,0,',','.').' đ</span></li></p>'
															?>
														</p>
														<p>
															<?php
																$total_after_coupon = $total -$total_coupon;
															?>
														</p>
														@elseif($cou['coupon_condition'] == 2)
														Giảm: <span>{{number_format($cou['coupon_number'],0,',','.')}} đ</span>
														<p>
															<?php
																$total_coupon = $total - $cou['coupon_number']; 
																echo '<p><li>Tổng Giảm: <span>'.number_format($total_coupon,0,',','.').' đ</span></li></p>'
															?>
														</p>
														<p>
															<?php
																$total_after_coupon = $total_coupon; 
															?>
														</p>
													@endif
												@endforeach
										</li>
										@endif
										<?php $total_after_fee = $total + 35000 ?>
                                        <li>Phí Vận Chuyển: <span>35.000 đ</span></li>
											<?php
												 if(session()->get('coupon')){
													$total_after_coupon_fee = $total_after_coupon + 35000;
													$total_after = $total_after_coupon_fee;
													echo '<p><li>Tổng Tiền: <span>'.number_format($total_after,0,',','.').' đ</span></li></p>';
												 }elseif(!session()->get('coupon')){
													$total_after = $total_after_fee;
													echo '<p><li>Tổng Tiền: <span>'.number_format($total_after,0,',','.').' đ</span></li></p>';
												 }
											?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @else
                            <tr>
                                <td colspan="5"><center>
                                <?php
                                    echo '<p>Chưa Có Sản Phẩm Được Thêm Vào Giỏ Hàng!!!</p>' 
                                ?>
                                </center></td>
                            </tr>
                        @endif
					</tbody>
					</form>
					@if(session()->get('cart') == true)
					<tr>
						<td>
							<form action="{{url('/check-coupon')}}" method="POST" >
								@csrf
								<div style="width: 100px; margin: 4px 30px; display: flex;" id="paypal_coupon">
									<input style="width: 190px; margin:0 6px;" type="text" class="form-control" name="coupon" placeholder="Nhập Mã Giảm Giá">
									<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Áp Dụng">
								</div>
							</form>
						</td>
					</tr>
					<tr>
						<td>
							<?php
								$customer_id = session()->get('customer_id');
								if($customer_id != NULL){
								?>
									<div class="col-md-6" style="position: relative; left: 870px; top: -8px;">
										<?php
											$change_money = $total_after/23083; 
										?>
										<input type="hidden" id="change_money" value="{{round($change_money,2)}}">
										<div id="paypal-button-container"></div>		
									</div>
								<?php
								}else{
								?>
								<?php
									}
								?>
						</td>
					</tr>	
					@endif
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
    <!-- <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Tổng Giỏ Hàng</h3>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							
						</ul>
                            <a class="btn btn-default check_out" href="">Tiếp Tục Đặt Hàng</a>
                            <a class="btn btn-default check_out" href="">Mã Giảm Giá</a>
                            
					</div>
				</div>
			</div>
		</div>
	</section>/#do_action -->
@endsection