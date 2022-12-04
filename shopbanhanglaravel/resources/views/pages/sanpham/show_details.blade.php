@extends('layout')
@section('content')

@foreach($product_details as $key => $value)
<!--product-details-->
<div class="product-details">
						<style>
							.lSSlideOuter .lSPager.lSGallery img {
								display: block;
								height: 60px;
								max-width: 100%;
							}

							li.active{
								border: 2px solid #FE980F;
							}

							.breadcrum-custom{
								font-size: 1.6rem;
							}

							.breadcrum-custom:hover{
								border-bottom: 1px solid #000;
							}
						</style>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrum-item breadcrum-custom"><a href="{{url('/trang-chu')}}">Trang Chủ</a></li>
								<li class="breadcrum-item breadcrum-custom"><a href="{{url('/danh-muc-san-pham/'.$cate_slug)}}">{{$product_cate}}</a></li>
								<li class="breadcrum-item active breadcrum-custom" aria-current="page" style="border: none;">{{$meta_title}}</li>
							</ol>
						</nav>
						<div class="col-sm-5">
						<ul id="imageGallery">
							<li data-thumb="{{asset('/public/uploads/product/' .$value->product_image)}}" data-src="{{asset('/public/uploads/product/' .$value->product_image)}}">
								<img width="100%" src="{{URL::to('/public/uploads/product/' .$value->product_image)}}" />
							</li>
							@foreach($gallery as $key => $gal)
								<li data-thumb="{{asset('/public/uploads/gallery/'.$gal->gallery_name)}}" data-src="{{asset('/public/uploads/gallery/'.$gal->gallery_name)}}">
									<img width= 100% src="{{URL::to('/public/uploads/gallery/'.$gal->gallery_name)}}" alt="" />
								</li>
							@endforeach
						</ul>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2 style="font-size: 2.8rem; font-weight: 700;">{{$value->product_name}}</h2>
								<p style="color: #000; font-weight: 500; font-size: 1.8rem;">Mã ID: SP{{$value->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
                                <form>
								<span style="margin-top: 0px; color: #000; font-weight: 500; font-size: 2rem;">Giá: {{number_format($value->product_price).'đ'}}</span>
								@if($value->product_quantity > 0)
									<div>
										<span style="color: #000; font-weight: 500; font-size: 1.8rem;">Số Lượng:</span>
										<input name="qty" style="width: 40px;" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
										<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
									</div>
								@else
									<div>
										<span style="color: #000; font-weight: 500; font-size: 1.8rem;">Số Lượng:</span>
										<input name="qty" disabled style="width: 40px;" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
										<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
									</div>
								@endif
             					<input name="productid_hidden" type="hidden" min="1" value="{{$value->product_id}}" />
								@csrf
								<input type="hidden" value="{{$value->product_id}}"  class="cart_product_id_{{$value->product_id}}">
								<input type="hidden" value="{{$value->product_name}}"  class="cart_product_name_{{$value->product_id}}">
								<input type="hidden" value="{{$value->product_image}}"  class="cart_product_image_{{$value->product_id}}">
								<input type="hidden" value="{{$value->product_price}}"  class="cart_product_price_{{$value->product_id}}">
								<input type="hidden" value="{{$value->product_quantity}}"  class="cart_product_quantity_{{$value->product_id}}">
								<input type="hidden" value="1"  class="cart_product_qty_{{$value->product_id}}">
								@if($value->product_quantity > 0)
									<button 
										style="
										margin-top: 10px; 
										background: #fff; 
										color: #000; 
										border: 1px solid #FF3D2B; 
										border-radius: 10px; font-size: 14px; 
										font-weight: 700; 
										height: 46px; width: 125px; 
										line-height: 20px; 
										padding: 5px 10px" 
										type="button" class="btn btn-default add-to-cart" 
										data-id_product = {{$value->product_id}} name="add-to-cart">Thêm Giỏ hàng
									</button>
								@else
									<button 
										style="
										margin-top: 10px; 
										background: #fff; 
										color: #000; 
										border: 1px solid #FF3D2B; 
										border-radius: 10px; font-size: 14px; 
										font-weight: 700; 
										height: 46px; width: 125px; 
										line-height: 20px; 
										padding: 5px 10px" 
										type="button" class="btn btn-default add-to-cart" disabled
										data-id_product = {{$value->product_id}} name="add-to-cart">Thêm Giỏ hàng
									</button>
								@endif						
                                </form>
								@if($value->product_quantity > 0)
									<p style="color: #000; font-weight: 500; font-size: 1.4rem;">Tình Trạng: Còn Hàng ({{$value->product_quantity}} Sản Phẩm)</p>
								@else
									<p style="color: #FF0000; font-weight: 500; font-size: 1.4rem;">Tình Trạng: Hết Hàng</p>
								@endif
								<p style="color: #000; font-weight: 500; font-size: 1.4rem;">Điều Kiệu: Mới</p>
								<p style="color: #000; font-weight: 500; font-size: 1.4rem;">Thương Hiệu:{{$value->brand_name}}</p>
                                <p style="color: #000; font-weight: 500; font-size: 1.4rem;">Danh Mục:{{$value->category_name}}</p>
								<p style="color: #000; font-weight: 500; font-size: 1.4rem;">Đánh Giá:
								<ul class="list-inline" title="Average Rating">
											@for($count = 1; $count <= 5; $count++)
												<?php 
													if($count <= $rating){
														$color = 'color:#f0ad4e;';
													}else{
														$color = 'color:#ccc;';
													}
												?>
												<li 
												style="cursor: pointer; {{$color}}; font-size: 30px;">
												&#9733;
												</li>
											@endfor
									</ul>
								</p>
								<style>
									a.tags_style{
										margin: 3px 2px;
										border-bottom: 1px solid;
										height: auto;
										color: #000;
										padding: 0px;
										font-size: 1.8rem;
									}

									a.tags_style:hover{
										
										border: 1px solid blueviolet;
										border-radius: 20%;
									}
								</style>
								<fieldset>
									<legend>Tags</legend>
									<p><i class="fa fa-tag"></i>
										<?php
											$tags = $value->product_tags;
											$tags = explode(",", $tags);
										?>
										@foreach($tags as $tag)
											<a href="{{url('/tag/'.$tag)}}" class="tags_style">{{$tag}}</a>
										@endforeach
									</p>
								</fieldset>
							</div><!--/product-information-->
						</div>
					</div>
                    <!--/product-details-->
					@endforeach
                    <!--category-tab-->
                    <div class="category-tab shop-details-tab">
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Chi Tiết</a></li>  
								<li><a href="#descreption" data-toggle="tab">Mô Tả Sản Phẩm</a></li>
								<li><a href="#reviews" data-toggle="tab">Đánh Giá ({{$comment_count}})</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">{!!$value->product_content!!}</p>
							</div>
                            <div class="tab-pane fade" id="descreption" >
								<p style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">{!!$value->product_desc!!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- comment -->
							<style>
								.style_comments{
									border: 1px solid #ddd;
									border-radius: 10px;
									background: #F0F0E9;
								}
							</style>

							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>User</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>
											<span id="hours"></span>
											</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>
											<span id="current_date"></span>
										</a></li>
									</ul>
									<form>
										@csrf
										<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
										<div id="comment_show"></div>
									</form>
									
									
									<p style="width: 200px; font-size: 1.8rem;"><b>Bình Luận Của Bạn</b></p>
									<ul class="list-inline" title="Average Rating">
											@for($count = 1; $count <= 5; $count++)
												<?php 
													if($count <= $rating){
														$color = 'color:#f0ad4e;';
													}else{
														$color = 'color:#ccc;';
													}
												?>
												<li 
												id="{{$value->product_id}}-{{$count}}"
												data-index="{{$count}}"
												data-product_id="{{$value->product_id}}"
												data-rating="{{$rating}}"
												class="rating" 
												style="cursor: pointer; {{$color}}; font-size: 30px;">
												&#9733;
												</li>
											@endfor
									</ul>
									<form action="#">
										<div id="notification"></div>
										<span>
											<input style="margin: 0; background: #fff; border: 1px solid #000; border-radius: 10px; font-size: 1.6rem; color: #000;" class="comment_name" type="text" placeholder="Tên Bình Luận" require/>
										</span>
										<div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
											<div class="d-flex flex-start w-100" style="margin: 10px 0;">
												<img class="rounded-circle shadow-1-strong me-3"
													src="{{asset('public/frontend/images/user.png')}}" alt="avatar" width="40"
													height="40"/>

												<div class="form-outline w-100">
													<textarea name="comment" class="form-control comment_content" id="textAreaExample" rows="4"
													style="background: #fff; border: 1px solid #000; font-size: 1.6rem; border-radius: 10px; color: #000;" placeholder="Comment..."></textarea>
												</div>

											</div>
										</div>
										<button type="button" class="btn btn-default pull-right send-comment">
											Bình Luận
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div>
                    <!--/category-tab-->

                    <!--recommended_items-->
                    <div class="recommended_items">
						<h2 class="title text-center">Sản Phẩm Liên Quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
                                    @foreach($relate as $key => $recom)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
                                        <div class="single-products">
										<div class="productinfo text-center">
										<a href="{{URL::to('/chi-tiet-san-pham/'.$recom->product_id)}}">
											<img src="{{URL::to('public/uploads/product/' .$recom->product_image)}}" alt="" style="width: 140px;"/>
											<h4 style="color: #000; font-weight: 500; font-size: 1.4rem;">{{$recom->product_name}}</h4>
										</a>
										</div>
									</div>
										</div>
									</div>
                                    @endforeach
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div>
                    <!--/recommended_items-->
@endsection