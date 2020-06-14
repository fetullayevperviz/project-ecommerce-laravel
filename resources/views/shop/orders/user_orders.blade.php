@extends('shop.layouts.master')
@section('title','Ecommerce İstifadəçi sifarişləri')
@section('content')

<div class="cart-box-main">
    <div class="container">
        <h1 align="center">İstifadəçi sifarişləri</h1> <br><br>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="text-align:center;">Sifariş No</th>
                            <th style="text-align:center;">Məhsul adı</th>
                            <th style="text-align:center;">Ödəmə üsulu</th>
                            <th style="text-align:center;">Ümumi Hesab</th>
                            <th style="text-align:center;">Sifariş tarixi</th>
                            <th style="text-align:center;">Əməliyyatlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                          <tr>
                             <td style="text-align:center;">{{$order->id}}</td>
                             <td style="text-align:center;">
                                 @foreach($order->orders as $pro)
                                   <a href="{{url('/orders/'.$order->id)}}">
                                       {{$pro->product_name}}<br>
                                       Məhsul kodu : ({{$pro->product_code}})<br>
                                       Sifariş sayı : ({{$pro->product_quantity}})<br>
                                   </a><br>
                                 @endforeach
                             </td>
                             <td style="text-align:center;">{{$order->payment_method}}</td>
                             <td style="text-align:center;">{{number_format(($order->grand_total),2)}} AZN</td>
                             <td style="text-align:center;">{{$order->created_at}}</td>
                             <td style="text-align:center;">Goster</td>
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