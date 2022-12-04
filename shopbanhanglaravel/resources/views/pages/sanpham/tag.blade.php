@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Tag Tìm Kiếm: {{$product_tag}}</h2>
						@foreach($pro_tag as $key =>$product)
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
													<h2 class="text-decoration-line-through">{{number_format($product->product_price).'đ'}}</h2>
													<p>{{($product->product_name)}}</p>
												</a>
												<button type="button" class="btn btn-default add-to-cart" data-id_product = {{$product->product_id}} name="add-to-cart">Thêm Giỏ hàng</button>
											</form></form>
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
					{{$pro_tag->links()}}
@endsection
