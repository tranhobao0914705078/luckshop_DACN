<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- SEO -->
	<meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>

    <meta name="robots" content="INDEX,FOLLOW"/>
	<link  rel="canonical" href="{{$url_canonical}}" />
	<link rel="icon" type="image/x-icon" href="">

	<!-- social -->
	
    <meta property="og:site_name" content="http://localhost/shopbanhanglaravel/" />
    <meta property="og:description" content="{{$meta_desc}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" />
	<!-- END SEO -->
    <meta name="author" content="">
    <title>{{$meta_title}}</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/custom.css')}}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('public/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('public/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('public/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('public/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="logo-container">
							<ul>
								<li>
									<div class="logo-holder logo-1">
										<a href="{{URL::to('/trang-chu')}}"><h3 class="logo-custom">Luck-Shop</h3></a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-10">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<!-- <li><a href="#"><i class="fa fa-star"></i> Yêu Thích</a></li> -->
								<?php
									$customer_id = session()->get('customer_id');
									if($customer_id != NULL){
								?>
								<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
								<?php
									}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
								<?php
									}
								?>
								
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a></li>
								<?php
									$customer_id = session()->get('customer_id');
									if($customer_id != NULL){
								?>
									<li>
										<a href="{{URL::to('/history')}}"><i class="fa-solid fa-clock-rotate-left"></i>Lịch Sử Đơn Hàng</a>
									</li>
								<?php
								}
								?>
								<?php
									$customer_id = session()->get('customer_id');
									if($customer_id != NULL){
								?>
									<li>
										<a href="{{URL::to('/view-profile/'.session()->get('customer_id'))}}"><i class="fa-solid fa-user"></i>Thông Tin Cá Nhân</a>
									</li>
									<li>
										<a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i>Đăng Xuất</a>
									</li>
								<?php
									}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng Nhập</a></li>
								<?php
									}
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang Chủ</a></li>
								<li class="dropdown"><a href="#">Sản Phẩm<i class="fa fa-angle-down"></i></a>
								
                                    <ul role="menu" class="sub-menu">
									@foreach($category as $key => $cate)
                                        <li><a href="{{URL::to('/danh-muc-san-pham/' .$cate->category_id)}}">{{$cate->category_name}}</a></li>
									@endforeach
                                    </ul>
								
                                </li> 
								<li class="dropdown"><a href="#">Tin Tức<i class="fa fa-angle-down"></i></a>
                                </li> 
								<li><a href="{{URL::to('/show-cart')}}">Giỏ Hàng</a></li>
								<li><a href="{{URL::to('/contact')}}">Liên Hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-5">
						<form action="{{URL::to('/tim-kiem')}}" autocomplete="off" method="POST">
							{{csrf_field() }}
							<div class="search_box">
								<input style="margin: 0 -150px; width: 400px; color: #000; font-weight: 500; font-size: 1.2rem;" type="text" name="keywords_submit" id="keywords" placeholder="Tìm Kiếm Sản Phẩm..."/>
								<div id="search_item"></div>
								<input style="color: #666; font-size: 1.6rem; font-weight: 500; margin: 0 255px; position: relative; top: -34px;" type="submit" name="search_items" class="btn btn-primary btn-sm" value="Tìm Kiếm">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>Luck</span>SHOP</h1>
									<h2>Thế Giới Đồ Công Nghệ</h2>
									<p>Laptop ASUS giảm giá cực mạnh vào tháng cuối năm 2022</p>
									<button type="button" class="btn btn-default get">Xem cửa hàng</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/frontend/images/asus.jpg')}}" width="319" class="girl img-responsive" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>Luck</span>SHOP</h1>
									<h2>Thế Giới Đồ Công Nghệ</h2>
									<p>Apple Macbook Air M2 2022 8GB 256GB I Chính hãng Apple Việt Nam</p>
									<button type="button" class="btn btn-default get">Xem cửa hàng</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/frontend/images/macbook1.jpg')}}" width="319" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>Luck</span>SHOP</h1>
									<h2>Thế Giới Đồ Công Nghệ</h2>
									<p>iPhone 14 Pro 1TB | Chính hãng VN/A</p>
									<button type="button" class="btn btn-default get">Xem cửa hàng</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/frontend/images/iPhone14.png')}}" width="319" class="girl img-responsive" alt="" />
									
								</div>
							</div>
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh Mục Sản Phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/' .$cate->category_id)}}">{{$cate->category_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương Hiệu Sản Phẩm</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								@foreach($brand as $key => $bra)
									<li><a href="{{URL::to('/thuong-hieu-san-pham/' .$bra->brand_id)}}">{{$bra->brand_name}}</a></li>
								@endforeach
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<!--price-range-->
						<!-- <div class="price-range">
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div> -->
						
					
					</div>
				</div>
				<div class="col-sm-9 padding-right">
					@yield('content')
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="companyinfo">
							<h2 style="font-size: 6rem;"><span>Luck</span>-Shop</h2>
							<p>Thế Giới Đồ Công Nghệ</p>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="col-sm-6" style="display: flex; margin: 10px 0px;">
						@foreach($brand as $key => $val_brand)
							<div class="text-center" style="margin: 0 20px;">
								<a href="{{URL::to('/thuong-hieu-san-pham/' .$val_brand->brand_id)}}"><img width="180" height="120" src="{{URL::to('public/uploads/brand/' .$val_brand->brand_product_image)}}" alt="" /></a>
								<h3 style="position: relative; top: 10px; cursor: pointer;"><a style="color: #000;" href="{{URL::to('/thuong-hieu-san-pham/' .$val_brand->brand_id)}}">{{$val_brand->brand_name}}</a></h3>
							</div>
						@endforeach
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-widget" style="background-color: #000;">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2 style="color: #fff; font-weight: 500;">Dịch vụ</h2>
							<ul class="nav nav-pills nav-stacked" style="text-transform: uppercase; color: #fff" >
								<li><a href="#">Hỗ trợ trực tuyến</a></li>
								<li><a href="{{URL::to('/contact')}}">Liên Hệ</a></li>
								<?php
									$customer_id = session()->get('customer_id');
									if($customer_id != NULL){
								?>
									<li>
										<a href="{{URL::to('/history')}}">Lịch Sử Đơn Hàng</a>
									</li>
								<?php
									}
								?>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2 style="color: #fff; font-weight: 500;">CỬA HÀNG</h2>
							<ul class="nav nav-pills nav-stacked">
								@foreach($category as $key => $cate)
                                    <li><a style="text-transform: uppercase;" href="{{URL::to('/danh-muc-san-pham/' .$cate->category_id)}}">{{$cate->category_name}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="col-sm-2" style="width: 242px;">
						<div class="single-widget">
							<h2 style="color: #fff; font-weight: 500;">HỖ TRỢ KHÁCH HÀNG</h2>
							<ul class="nav nav-pills nav-stacked" style="text-transform: uppercase;">
								<li><a href="#">CHÍNH SÁCH THANH TOÁN</a></li>
								<li><a href="#">CHÍNH SÁCH BẢO MẬT</a></li>
								<li><a href="#">CHÍNH SÁCH ĐỔI TRẢ</a></li>
								<li><a href="#">CHÍNH SÁCH VẬN CHUYỂN</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget" style="width: 400px; margin: 19px 0;">
							<p style="color: #fff; font-weight: 500;">CÔNG TY TNHH LUCK-SHOP</p></br>
							<p style="color: #fff; font-weight: 500;"><i class="fa-solid fa-location-dot"></i> ĐỊA CHỈ: Việt Nam, Thành phố Hồ Chí Minh, Quận 9, Phân khu đào tạo E1,Khu Công Nghệ Cao</p></br>
						    <p style="color: #fff; font-weight: 500;"><i class="fa-solid fa-phone"></i> Phone: +84 1234 56789</p></br>
							<p style="color: #fff; font-weight: 500;"><i class="fa-solid fa-envelope"></i><a href="mailto: @(Model.ContactDetail.Email)"> Mail: luckshop@gmail.com</a></p>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget" style="width: 400px; margin: 19px 320px;">
							<h2 style="color: #fff; font-weight: 500;">QR-LuckShop</h2>
							<img style="width: 150px; margin: 32px 0; border: 1px solid;"src="{{asset('public/frontend/images/qr.png')}}" alt="" />
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>

	<script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
	<script src="{{asset('public/frontend/js/prettify.js')}}"></script>
	<script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
	<!-- socical -->
	<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="0fzZhYlR"></script>
	<!-- end social -->
	<script>
	$(document).ready(function() {
		$('#imageGallery').lightSlider({
			gallery:true,
			item:1,
			loop:true,
			thumbItem:4,
			slideMargin:0,
			enableDrag: false,
			currentPagerPosition:'left',
			onSliderLoad: function(el) {
				el.lightGallery({
					selector: '#imageGallery .lslide'
				});
			}   
		});  
  	});
	</script>
	<script>
	  var amountt= document.getElementById("change_money").value; 
      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: amountt // Can also reference a variable or function
              }
            }]
          });
        },
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
           
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Thanh Toán Qua Paypal ${transaction.status}: ${transaction.id}\n\n Cảm Ơn Bạn Đã Đặt Hàng Tại Luck-Shop`);
			var delete_cart = document.getElementById("btn_delete-cart").style.display = "none";
			var update_cart= document.getElementById("btn_update-cart").style.display = "none";
			var coupon_cart = document.getElementById("paypal_coupon").style.display = "none";
          });
        }
      }).render('#paypal-button-container');
    </script>
	<script>
		function remove_background(product_id){
			for(var count =  1; count <= 5; count++){
				$('#'+product_id+'-'+count).css('color', '#ccc');
			}
		}

		$(document).on('mouseenter', '.rating', function(){
			var index = $(this).data("index");
			var product_id = $(this).data("product_id");
			remove_background(product_id);
			for(var count = 1; count <= index; count++){
				$('#'+product_id+'-'+count).css('color', '#ffcc00');
			}
		}) 

		$(document).on('click', '.rating', function(){
			var index = $(this).data("index");
			var product_id = $(this).data('product_id');
			var _token = $('input[name="_token"]').val();
			$.ajax({
					url: "{{url('/insert-rating')}}",
					method: 'POST',
					data: {product_id:product_id, _token:_token, index:index},
					success:function(data){
						if(data == 'done'){
							alert("Cảm Ơn Bạn Đã Đánh Giá Sản Phẩm!!!")
							location.reload();
						}else{
							alert("Lỗi Đánh Giá!!!")
						}
					}
				})
		});
	</script>
	<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
	<!-- order -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.send_order').click(function(){
				swal({
					title: "Xác Nhận Đơn Hàng?",
					text: "Đơn Hàng Sẽ Được Ghi Nhận Lại Vào Hệ Thống!!!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Xác Nhận",
					cancelButtonText: "Đóng",
					closeOnConfirm: false,
					closeOnCancel: false
					},
					function(isConfirm){
						if (isConfirm) {
							var shipping_email = $('.shipping_email').val();
							var shipping_name = $('.shipping_name').val();
							var shipping_phone = $('.shipping_phone').val();
							var shipping_address = $('.shipping_address').val();
							var shipping_notes = $('.shipping_notes').val();
							var shipping_method = $('.shipping_method').val();
							var order_coupon = $('.order_coupon').val();
							var _token = $('input[name="_token"]').val();
							$.ajax({
								url: "{{url('/confirm-order')}}",
								method: 'POST',
								data: {shipping_email: shipping_email, shipping_name: shipping_name, shipping_phone: shipping_phone
								,shipping_address: shipping_address,shipping_notes: shipping_notes,order_coupon: order_coupon
								,shipping_method: shipping_method ,_token:_token},
								success:function(data){
									swal("Xác Nhận!", "Cảm Ơn Bạn Đã Đặt Hàng Tại Luck-Shop.", "success");
									window.setTimeout(() => {
										location.href = "{{url('/history')}}";
									}, 2000);
								}
							});
						} else {
							swal("Đã Hủy", "Đặt Hàng Thất Bại", "error");
						}
				});
			});
		});
	</script>
	<!-- sort -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#sort').on('change', function(){
				var url = $(this).val();
				if(url){
					window.location = url;
				}
				return false;
			})
		});
	</script>
	<!-- comment -->
	<script>
		$(document).ready(function(){
			load_Comment();
			function load_Comment(){
				var product_id = $('.comment_product_id').val();
				var _token = $('input[name = "_token"]').val();
				$.ajax({
					url: "{{url('/load-comment')}}",
					method: 'POST',
					data: {product_id:product_id, _token:_token},
					success:function(data){
						$('#comment_show').html(data);
					}
				})
			}
			$('.send-comment').click(function(){
				var product_id = $('.comment_product_id').val()
				var comment_name = $('.comment_name').val()
				var comment_content = $('.comment_content').val()
				var _token = $('input[name = "_token"]').val();
				$.ajax({
					url: "{{url('/send-comment')}}",
					method: 'POST',
					data: {product_id:product_id, _token:_token, comment_name:comment_name, comment_content:comment_content},
					success:function(data){
						$('#notification').html('<span class="text text-success">Thêm Bình Luận Thành Công</span>');
						load_Comment();
						$('#notification').fadeOut(3000);
						$('.comment_name').val('')
						$('.comment_content').val('')
					}
				})
			})
		})
	</script>
	<script>
		$(function(){
		$(".change_pass a").click(function(){
			var $this = $(this);
			if($this.hasClass('active')){
				$this.parents('.change_pass').find('input').attr('type','password');
				$this.removeClass('active');
			}else{
				$this.parents('.change_pass').find('input').attr('type','text');
				$this.addClass('active');
			}
		})
	})
	</script>
	<script>
		$(document).ready(function(){
			$('.title_user').fadeOut(3000);
		})
	</script>
	<script>
		var curDate = new Date();

		var curDay = curDate.getDate();
		var curMonth = curDate.getMonth() + 1;
		var curYear = curDate.getFullYear();
		document.getElementById('current_date').innerHTML = curDay + "/" + curMonth + "/" + curYear;

 		var time = curDate.getHours() + ":" + curDate.getMinutes() + ":" + curDate.getSeconds();
 
 		document.getElementById("hours").innerHTML = time;
	</script>
	<!-- search -->
	<script type="text/javascript">
		$('#keywords').keyup(function(){
			var query = $(this).val()
			if(query != ''){
				var _token = $('input[name = "_token"]').val();
				$.ajax({
					url: "{{url('/autocomplete-search')}}",
					method: 'POST',
					data: {query:query, _token:_token},
					success:function(data){
						$('#search_item').fadeIn();
						$('#search_item').html(data);
					}
				})
			}else{
				$('#search_item').fadeOut();
			}
		})
		$(document).on('click', 'li', function(){
			$('#keywords').val($(this).text());
			$('#search_item').fadeOut();
		})
	</script>
	<!-- cart -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_quantity = $('.cart_product_quantity_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				if(parseInt(cart_product_qty) > parseInt(cart_product_quantity)){
					alert('Sản Phẩm Hiện Tại Hết Hàng!!!');
				}else{
					$.ajax({
						url: "{{url('/add-cart-ajax')}}",
						method: 'POST',
						data: {cart_product_id: cart_product_id, cart_product_name: cart_product_name, cart_product_image: cart_product_image, cart_product_price: cart_product_price
						, cart_product_qty: cart_product_qty, _token:_token, cart_product_quantity:cart_product_quantity},
						success:function(data){
							swal({
									title: "Đã thêm sản phẩm vào giỏ hàng",
									text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
									showCancelButton: true,
									cancelButtonText: "Xem tiếp",
									confirmButtonClass: "btn-success",
									confirmButtonText: "Đi đến giỏ hàng",
									closeOnConfirm: false
								},
								function() {
									window.location.href = "{{url('/gio-hang')}}";
								});

						}

					});
				}
			});
		});
	</script>
	<!--Cancel Order  -->
	<script>
		function CancelOrderCustomer(id){
			var id = id;
			var reason = $('.reasonCancel').val();
			var _token = $('input[name="_token"]').val();
			$.ajax({
					url: "{{url('/cancel-order')}}",
					method: 'POST',
					data: {id:id, _token:_token, reason:reason},
					success:function(data){
						alert("Hệ Thống Đã Ghi Nhận Hủy Đơn Hàng Của Bạn!!!");
						location.reload();
					}
				})
		}
	</script>
	<script>
		var hideElement = document.querySelector('.alert');
		setTimeout(() => {
			hideElement.stye.display = 'none';
		}, 1000);
	</script>
</body>
</html>