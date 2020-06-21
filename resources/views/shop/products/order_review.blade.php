@extends('shop.layouts.master')
@section('title','Ecommerce Checkout')
@section('content')
<div class="contact-box-main">
<div class="container">
<div class="row">
{{--@if($errors->any())
    <div class="alert alert-danger">
       @foreach($errors->all() as $error)
         <li>{{$error}}</li>
       @endforeach
    </div>
@endif--}}
<div class="col-sm-12 col-lg-6">
<div class="contact-form-right">
<h3><div id="qeydiyyat">Hesab Məlumatları</div></h3>		
<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
		    {{$userDetails->name}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$userDetails->address}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$userDetails->city}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
             {{$userDetails->state}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$userDetails->country}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$userDetails->pincode}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$userDetails->mobile}}
		</div>
	</div>
</div>
</div>
</div>

<div class="col-sm-12 col-lg-6">
<div class="contact-form-right">
<h3><div id="daxil">Göndərmə Məlumatları</div></h3>
<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			{{$shippingDetails->name}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$shippingDetails->address}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$shippingDetails->city}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$shippingDetails->state}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$shippingDetails->country}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$shippingDetails->pincode}}
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			{{$shippingDetails->mobile}}
		</div>
	</div>
</div>	
</div>
</div>
</div>
</div>
</div>
</div>

<!-- Start Cart  -->
<div class="cart-box-main">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-main table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align:center;">Məhsulun şəkili</th>
                            <th style="text-align:center;">Məhsulun adı</th>
                            <th style="text-align:center;">Məhsulun qiyməti</th>
                            <th style="text-align:center;">Məhsulun sayı</th>
                            <th style="text-align:center;">Ümumi qiymət</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $total_amount = 0; ?>
                        @foreach($userCart as $cart)
                           <tr style="text-align:center;">
	                            <td class="thumbnail-img">
	                                <a href="#">
								       <img class="img-fluid" src="{{asset('/uploads/product/'.$cart->image)}}"/>
							        </a>
	                            </td>
	                            <td class="name-pr">
	                                <a href="#">
								         {{$cart->product_name}}
							        </a>
	                            </td>
	                            <td class="price-pr">
	                                <p>{{number_format($cart->price,2)}} AZN</p>
	                            </td>
	                            <td>
				                    <a href="{{url('/cart/update-quantity/'.$cart->id.'/1')}}" style="font-size:25px;"> + </a>
					            	<input type="number" style="text-align:center;" size="2" value="{{$cart->quantity}}" min="0" step="1">
				                    @if($cart->quantity>1)
				                    <a href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}" style="font-size:25px;"> - </a>
				                    @endif
					            </td>
	                            <td class="total-pr">
	                                <p>{{number_format(($cart->price*$cart->quantity),2)}} AZN</p>
	                            </td>
	                        </tr>
	                        <?php $total_amount = $total_amount + ($cart->price * $cart->quantity); ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
           <div class="order-box">
                <h2 style="text-align:center;">Sizin sifarişiniz</h2>
                <div class="d-flex">
                    <h4>Hesab</h4>
                    <div class="ml-auto font-weight-bold"> {{number_format($total_amount,2)}} AZN</div>
                </div>
                <div class="d-flex">
                    <h4>Çatdırılma üçün ödəniləcək məbləğ (+)</h4>
                    <div class="ml-auto font-weight-bold"> 0 AZN </div>
                </div>
                <hr class="my-1">
                <div class="d-flex">
                    <h4>Kupon endirimi (-)</h4>
                    <div class="ml-auto font-weight-bold">
                    	@if(!empty(Session::get('CouponAmount')))
                    	  {{number_format((Session::get('CouponAmount')),2)}}
                    	@else
                    	  0 AZN
                    	@endif
                    </div>
                </div>
                <hr>
                <div class="d-flex gr-total">
                    <h5>Ödəniləcək məbləğ</h5>
                    <div class="ml-auto h5"> {{number_format($grand_total = $total_amount - Session::get('CouponAmount'),2)}} AZN</div>
                </div>
                <hr> 
            </div>
        </div>
    </div>

    <form action="{{url('/place-order')}}" name="paymentForm" id="paymentForm" method="post">
    	@csrf
    	<input type="hidden" name="grand_total" value="{{$grand_total}}">
    	<hr class="mb-4">
    	<div class="title-left">
    		<h3>Ödənişlər</h3>
    	</div>
    	<div class="d-block my-3">
    		<div class="custom-control custom-radio">
    			<input type="radio" name="payment_method" value="cod" id="credit" class="custom-control-input cod">
    			<label class="custom-control-label" for="credit">Çatdırılma üzrə nağd pul</label>
    		</div>
    		<div class="custom-control custom-radio">
    			<input type="radio" name="payment_method" value="paypal" id="debit" class="custom-control-input stripe">
    			<label class="custom-control-label" for="debit">Stripe</label>
    		</div>
    		<div class="col-12 d-flex shopping-box">
    			<button type="submit" class="ml-auto btn hvr-hover" onclick="return selectPaymentMethod();" style="color:white;">Sifariş</button>
    		</div>
    	</div>
    </form>
</div>
</div>
<!-- End Cart -->
@endsection