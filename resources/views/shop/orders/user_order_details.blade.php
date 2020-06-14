@extends('shop.layouts.master')
@section('title','Ecommerce İstifadəçi məlumatları')
@section('content')

<div class="cart-box-main">
    <div class="container">
        <h1 align="center">İstifadəçi sifarişləri</h1> <br><br>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="text-align:center;">Məhsul kodu</th>
                            <th style="text-align:center;">Məhsul adı</th>
                            <th style="text-align:center;">Ölçü</th>
                            <th style="text-align:center;">Rəng</th>
                            <th style="text-align:center;">Qiymət</th>
                            <th style="text-align:center;">Sifariş sayı</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderDetails->orders as $pro)
                          <tr>
                             <td style="text-align:center;">{{$pro->product_code}}</td>
                             <td style="text-align:center;">{{$pro->product_name}}</td>
                             <td style="text-align:center;">{{$pro->product_size}}</td>
                             <td style="text-align:center;">{{$pro->product_color}}</td>
                             <td style="text-align:center;">{{number_format($pro->product_price,2)}} AZN</td>
                             <td style="text-align:center;">{{$pro->product_quantity}}</td>
                           </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

<?php 
    Session::forget('order_id');
    Session::forget('grand_total');
 ?>