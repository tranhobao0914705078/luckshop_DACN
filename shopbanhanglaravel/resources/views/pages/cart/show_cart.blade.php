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
			<div class="table-responsive cart_info">
                <?php
				use Gloudemans\Shoppingcart\Facades\Cart; 
                    $content = Cart::content();
                ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
                            <td class="description">Tên Sản Phẩm</td>
							<td class="image">Hình Ảnh</td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Tổng Tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        @foreach($content as $v_content)
						<tr>
                            <td class="cart_description">
                            <p style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">{{$v_content->name}}</p>
							</td>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/' .$v_content->options->image)}}" width="80" alt="" /></a>
							</td>
							<td class="cart_price">
                                <p style="font-size: 1.8rem; font-weight: 700; margin:0 10px;">{{number_format($v_content->price).'đ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
									{{csrf_field() }}
									<input class="cart_quantity_input" type="number" name="cart_quantity" value="{{$v_content->qty}}">

									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">

									<input type="submit" value="Cập Nhật" name="update_qty" class="btn btn-secondary btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
                                <p class="cart_total_price">
                                    <?php
                                        $subtotal = $v_content->price * $v_content->qty;
                                        echo number_format($subtotal).'đ'; 
                                    ?>
                                </p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/' .$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
    <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Tổng Giỏ Hàng</h3>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{Cart::priceTotal(0).'đ'}}</span></li>
							<li>Thuế <span>{{Cart::tax(0).'đ'}}</span></li>
							<li>Phí Vận Chuyển <span>35.000đ</span></li>
							<li>Thành Tiền <span>{{Cart::total(0)}}</span></li>
						</ul>
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
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection