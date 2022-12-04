<!DOCTYPE html>
<head>
<title>Trang Quản Lý Admin Web</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="public/backend/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="public/backend/css/style.css" rel='stylesheet' type='text/css' />
<link href="public/backend/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="public/backend/stylesheet" href="css/font.css" type="text/css"/>
<link href="public/backend/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="public/backend/js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng Ký</h2>
	<?php
	use Illuminate\Contracts\Session\Session;
	$message = session()->get('message');
	if($message){
		echo '<span class="text-alert">',$message,'</span>';
		session()->put('message', null);
	}
    ?>
		<form action="{{URL::to('/register')}}" method="post">
            {{csrf_field()}}
            <input type="text" class="ggg" name="admin_name" placeholder="Nhập Tên" required>
			<input type="email" class="ggg" name="admin_email" placeholder="Nhập thông tin Email" required>
            <input type="number" class="ggg" name="admin_phone" placeholder="Nhập Số Điện Thoại" required>
			<input type="password" class="ggg" name="admin_password" placeholder="Nhập thông tin Password" required>
			<div class="clearfix"></div>
			<input type="submit" value="Đăng Ký" name="register">
		</form>
		<!-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> -->
</div>
</div>
<script src="public/backend/js/bootstrap.js"></script>
<script src="public/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="public/backend/js/scripts.js"></script>
<script src="public/backend/js/jquery.slimscroll.js"></script>
<script src="public/backend/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="public/backend/js/jquery.scrollTo.js"></script>
</body>
</html>
