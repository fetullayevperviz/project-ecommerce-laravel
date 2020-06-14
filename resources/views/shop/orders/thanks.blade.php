@extends('shop.layouts.master')
@section('title','Ecommerce Sifariş')
@section('content')

<div class="cart-box-main">
    <div class="container">
        <h1 align="center">Bizdən satın aldığınız üçün təşəkkür edirik!</h1> <br><br>
        <div class="row">
            <div class="col-lg-12">
                <div align="center">
                    <h2>Sifarişiniz qeydə alınıb</h2>
                    <p>Sifariş nömrəniz {{Session::get('order_id')}} və ümumi ödəmə haqqı {{number_format(Session::get('grand_total'),2)}} AZN-dir</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

<?php 
    Session::forget('order_id');
    Session::forget('grand_total');
 ?>