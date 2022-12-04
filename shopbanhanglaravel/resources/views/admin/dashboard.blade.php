@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <style>
        p.title_statistic{
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    <div class="row">
        <h2 class="title_statistic text-center" style="font-weight: bold">Thống Kê Doanh Thu</h2>
        <form autocomplete="off">
            @csrf
            <div class="col-md-2">
                <p>Từ Ngày: <input type="text" id="datepicker" class="form-control"></p>
                <input style="position: absolute; top: 25px; right: -600px;" type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc">
            </div>
            <div class="col-md-2">
                <p>Đến Ngày: <input type="text" id="datepicker2" class="form-control"></p>
            </div>
            <div class="col-md-2">
                <p>
                    Lọc Theo: 
                    <select class="dashboard-filter form-control">
                        <option>Chọn</option>
                        <option value="7day">7 Ngày Qua</option>
                        <option value="monthAgo">Tháng Trước</option>
                        <option value="month">Tháng Này</option>
                        <option value="yearAgo">1 Năm Qua</option>
                    </select>
                </p>
            </div>
        </form>

        <div class="com-md-12">
            <div id="myFirstChart" style="height: 250px; margin-top: 70px;"></div>
        </div>
        <h2 class="title_statistic text-center" style="margin: 10px 0; font-weight: bold">Đơn Hàng Trong Ngày</h2>
        <table class="table" style="margin: 30px 0;">
            <thead class="thead-dark" style="background-color: #000; color: #fff;">
                <tr>
                <th scope="col" style="font-weight: bold; color: #fff;" scope="col">STT</th>
                <th scope="col" style="font-weight: bold; color: #fff;" scope="col">Mã Đơn</th>
                <th scope="col" style="font-weight: bold; color: #fff;" scope="col">Ngày Đặt</th>
                <th scope="col" style="font-weight: bold; color: #fff;" scope="col">Tình Trạng</th>
                </tr>
            </thead>
            <?php 
            $i = 0;
            ?>
            <tbody>
                @foreach($order_now as $key => $val)
                <?php
                    $i++; 
                ?>
                <tr>
                    <td style="font-size: 1.2rem; color: #fff; font-weight: bold;"><i>{{$i}}</i></td>
                    <td style="font-size: 1.2rem; color: #fff; font-weight: bold;">{{$val->order_code}}</td>
                    <td style="font-size: 1.2rem; color: #fff; font-weight: bold;">{{$val->created_at}}</td>
                    <td style="font-size: 1.2rem; color: #fff; font-weight: bold;">
                    @if($val->order_status==1)
                        <p style="font-size: 1.2rem; color: #fff; font-weight: bold;"><b>Đơn Hàng Mới - Chưa Xử Lý</b></p>
                    @else
                        <p class="text-success"><b>Đã Xác Nhận - Vận Chuyển</b></p>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h2 class="title_statistic text-center" style="margin: 10px 0; font-weight: bold">Doanh Thu Trong Ngày</h2>
        <table class="table" style="margin: 30px 0;">
            <thead class="thead-dark" style="background-color: #000; color: #fff;">
                <tr>
                <th style="font-weight: bold; color: #fff;" scope="col">Số Lượng Đơn Hàng</th>
                <th style="font-weight: bold; color: #fff;" scope="col">Ngày Đặt</th>
                <th style="font-weight: bold; color: #fff;" scope="col">Số Lượng Bán</th>
                <th style="font-weight: bold; color: #fff;" scope="col">Tiền Bán</th>
                <th style="font-weight: bold; color: #fff;" scope="col">Lợi Nhuận</th>
                </tr>
            </thead>
          
            <tbody>
                @foreach($statistic_now as $key => $val)
               
                <tr>
                    <td style="font-size: 1.2rem; color: #fff; font-weight: bold;">{{$val->total_order}}</td>
                    <td style="font-size: 1.2rem; color: #fff; font-weight: bold;">{{$val->order_date}}</td>
                    <td style="font-size: 1.2rem; color: #fff; font-weight: bold;">{{$val->quantity}}</td>
                    <td style="font-size: 1.2rem; color: #fff; font-weight: bold;">{{number_format($val->sales,0,',','.')}} VNĐ</td>
                    <td style="font-size: 1.2rem; color: #fff; font-weight: bold;">{{number_format($val->profit,0,',','.')}} VNĐ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection