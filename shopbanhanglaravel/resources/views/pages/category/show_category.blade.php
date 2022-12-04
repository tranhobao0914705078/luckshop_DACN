@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
                        @foreach($category_name as $key => $name)
						<h2 class="title text-center">{{$name->category_name}}</h2>
                        @endforeach
						<div class="row" style="margin: 10px 20px;">
							<div class="col-md-4">
								<label class="text-secondary" for="amount" style="font-size: 1.8rem;">Sắp Xếp Theo</label>
								<form>
									@csrf
									<select name="sort" id="sort" class="form-control" style="width: 200px; text-align: center;">
										<option value="{{Request::url()}}?sort_by=none">Lọc</option>
										<option value="{{Request::url()}}?sort_by=tang_dan">Giá Tăng Dần</option>
										<option value="{{Request::url()}}?sort_by=giam_dan">Giá Giảm Dần</option>
										<option value="{{Request::url()}}?sort_by=kytu_az">A Đến Z</option>
										<option value="{{Request::url()}}?sort_by=kytu_za">Z Đến A</option>
									</select>
								</form>
							</div>
						</div>
						@foreach($category_by_id as $key => $product)
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
											<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
												<img width="100" height="260" src="{{URL::to('public/uploads/product/' .$product->product_image)}}" alt="" />
												<h2 class="text-decoration-line-through">{{number_format($product->product_price).'đ'}}</h2>
												<p>{{($product->product_name)}}</p>
											</a>
											<button type="button" class="btn btn-default add-to-cart" data-id_product = {{$product->product_id}} name="add-to-cart">Thêm Giỏ hàng</button>
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
						</div>
						{{$category_by_id->links()}}
					<div style="margin: 10px 16px;" class="fb-share-button" data-href="http://localhost/shopbanhanglaravel/" data-layout="button" data-size="large">
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" 
								class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
					<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="false"></div>
					<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="5"></div>
@endsection
