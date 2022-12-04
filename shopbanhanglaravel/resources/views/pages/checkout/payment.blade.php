@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
				  <li class="active">Thanh Toán Giỏ Hàng</li>
				</ol>
			</div>
			<div class="review-payment">
				<h2 style="color: #333; font-weight: 600; font-size: 2.15rem;">Xem lại giỏ hàng và thanh toán</h2>
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
							<td class="cart_description">
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
            <h4 style=" position: relative; top: -35px; margin: 10px 0; font-size: 20px; font-weight: 700;">Hình Thức Thanh Toán</h4>
            <form action="{{URL::to('/order-place')}}" method="POST">
            {{csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">Thanh toán bằng thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">Thanh toán khi nhận hàng</label>
					</span>
					<!-- <span>
						<label><input type="checkbox"> Paypal</label>
					</span> -->
			</div>
            <input class="btn btn-primary" 
				style="
                position: relative;
                top: -130px;
				font-size: 1.8rem; 
				width: 190px; 
				height: 40px; 
				border-radius: 25px" 
				type="submit" value="Đặt Hàng" name="send_order"
            >
            </form>
		</div>
</section> <!--/#cart_items-->
@endsection