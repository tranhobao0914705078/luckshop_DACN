<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="background: #222; border-radius: 12px; padding: 15px;">
        <div class="col-md-12">
            <p style="text-align: center; color: #fff;">Đây Là Mail Tự Động Được Gửi Từ Luck-Shop</p>
            <div class="row" style="background: cadetblue; padding: 15px;">
                <div class="col-md-6" style="text-align: center; color: #fff; font-weight: bold; font-size: 30px;">
                    <h4 style="margin: 0;">Cửa Hàng Luck-Shop</h4>
                    <h4 style="margin: 0;">Chuyên Các Sản Phẩm Công Nghệ</h4>
                </div>

                <div class="col-md-6 logo" style="color: #fff;">
                    <p>Chào Bạn: <strong style="color: #000; text-decoration: underline;">{{$shipping_array['customer_name']}}</strong>
                        ,Chúng Tôi Đã Xác Nhận Đơn Đặt Hàng Của Bạn Tại Hệ Thống Cửa Hàng Luck-Shop Với Thông Tin Như Sau:
                    </p>
                </div>
                <div class="col-md-12">
                    <p style="color: #fff; font-size: 17px;">Mail Xác Nhận Đơn Hàng Tại Luck-Shop Với Thông Tin Như Sau: </p>
                    <h4 style="color: #000; text-transform: uppercase;">Thông Tin Đơn Hàng</h4>
                    <p>
                        Mã Đơn Hàng: <strong style="color: #fff; text-transform: uppercase;">{{$code['order_code']}}</strong>
                    </p>
                    <p>
                        Mã Giảm Giá: <strong style="color: #fff; text-transform: uppercase;">{{$code['coupon_code']}}</strong>
                    </p>
                    <p>
                        Dịch Vụ: <strong style="color: #fff; text-transform: uppercase;">Đặt Hàng Trực Tuyến</strong>
                    </p>
                    <h4 style="color: #fff; text-transform: uppercase;">Thông Tin Người Nhận</h4>
                    <p>Email: 
                        @if($shipping_array['shipping_email'] == '')
                            Không Có
                        @else
                            <span style="color: #fff;">{{$shipping_array['shipping_email']}}</span>
                        @endif
                    </p>
                    <p>Họ Và Tên Người Gửi: 
                        @if($shipping_array['shipping_name'] == '')
                            Không Có
                        @else
                            <span style="color: #fff;">{{$shipping_array['shipping_name']}}</span>
                        @endif
                    </p>
                    <p>Địa Chỉ Nhận Hàng: 
                        @if($shipping_array['shipping_address'] == '')
                            Không Có
                        @else
                            <span style="color: #fff;">{{$shipping_array['shipping_address']}}</span>
                        @endif
                    </p>
                    <p>Số Điện Thoại: 
                        @if($shipping_array['shipping_phone'] == '')
                            Không Có
                        @else
                            <span style="color: #fff;">{{$shipping_array['shipping_phone']}}</span>
                        @endif
                    </p>
                    <p>Ghi Chú Đơn Hàng: 
                        @if($shipping_array['shipping_notes'] == '')
                            <span style="color: #fff;">Không Có</span>
                        @else
                            <span style="color: #fff;">{{$shipping_array['shipping_notes']}}</span>
                        @endif
                    </p>
                    <p>Hình Thức Thanh Toán: <strong style="text-transform: uppercase; color: #fff;">
                        @if($shipping_array['shipping_method'] == '')
                            <span style="color: #fff;">Tiền Mặt</span>  
                        @else
                            <span style="color: #fff;">Chuyển Khoản ATM</span>
                        @endif
                    </strong></p>
                    <p style="color: #fff;">Nếu Thông Tin Người Nhận Hàng Không Chính Xác Chúng Tôi Sẽ Liên Hệ Với Người Đặt Hàng Để Trao Đổi Thông TIn Về Đơn Hàng</p>
                    <h4 style="color: #000; text-transform: uppercase;">Sản Phẩm Đã Đặt</h4>
                    <table class="table table-striped" style="border: 1px;">
                        <thead>
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Giá Tiền</th>
                                <th>Số Lượng Đặt</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sub_total = 0;
                                $total = 0; 
                            ?>
                            @foreach($cart_array as $cart)
                            <?php
                                $sub_total = $cart['product_price'] * $cart['product_qty'];
                                $total += $sub_total; 
                            ?>
                            <tr>
                                <td>{{$cart['product_name']}}</td>
                                <td>{{number_format($cart['product_price'],0,',','.')}} vnđ</td>
                                <td>{{$cart['product_qty']}}</td>
                                <td>{{number_format($sub_total,0,',','.')}} vnđ</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right">Tổng Tiền Thanh Toán: {{number_format($total,0,',','.')}} vnđ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p style="color: #fff;">Cảm Ơn Bạn Đã Mua Hàng Tại Luck-Shop!!!</p>
            </div>
        </div>
    </div>
</body>
</html>