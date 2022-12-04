@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản Phẩm Mới Nhất</h2>
						@foreach($all_product as $key => $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<form>
												@csrf
												<input type="hidden" value="{{$product->product_id}}"  class="cart_product_id_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_name}}"  class="cart_product_name_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_image}}"  class="cart_product_image_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_price}}"  class="cart_product_price_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_quantity}}"  class="cart_product_quantity_{{$product->product_id}}">
												<input type="hidden" value="1"  class="cart_product_qty_{{$product->product_id}}">

												<a href="{{URL::to('/trang-chu/'.$product->product_id)}}">
													<img width="100" height="260" src="{{URL::to('public/uploads/product/' .$product->product_image)}}" alt="" />
													<h2 class="text-decoration-line-through">{{number_format($product->product_price,0,',','.')}} đ</h2>
													<p>{{($product->product_name)}}</p>
												</a>
												@if($product->product_quantity > 0)
													<button type="button" class="btn btn-default add-to-cart" name="add-to-cart" data-id_product = {{$product->product_id}}>Thêm Giỏ hàng</button>
												@else
													<p style="position: absolute; margin: -26px 76px; font-size: 1.8rem; font-weight: 600; color: red;">Đã Hết Hàng</p>
													<button type="button" disabled class="btn btn-default add-to-cart" name="add-to-cart" data-id_product = {{$product->product_id}}>Thêm Giỏ hàng</button>
												@endif
											</form>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm So Sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div><!--features_items-->
					{{$all_product->links()}}
@endsection
