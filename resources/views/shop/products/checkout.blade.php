@extends('shop.layouts.master')
@section('title','Ecommerce Checkout')
@section('content')
<div class="contact-box-main">
<div class="container">
<form action="{{url('/checkout')}}" method="POST" id="contactForm registerForm" autocomplete="off">
@csrf
<div class="row">
@if($errors->any())
    <div class="alert alert-danger">
       @foreach($errors->all() as $error)
         <li>{{$error}}</li>
       @endforeach
    </div>
@endif
<div class="col-sm-12 col-lg-6">
<div class="contact-form-right">
<h3><div id="qeydiyyat">Hesab</div></h3>		
<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" name="billing_name" id="billing_name" class="form-control" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" name="billing_address" id="billing_address" class="form-control" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" name="billing_city" id="billing_city" class="form-control" @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" name="billing_state" id="billing_state" class="form-control" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<select id="billing_country" name="billing_country" class="form-control">
				<option>Ölkə seçin</option>
				@foreach($countries as $country)
				   <option value="{{$country->countryname}}" @if(!empty($userDetails->country) && $country->countryname == $userDetails->country) selected @endif>{{$country->countryname}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" name="billing_pincode" id="billing_pincode" class="form-control" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="number" name="billing_mobile" id="billing_mobile" class="form-control" @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group" style="margin-left:30px;">
			<input type="checkbox" class="form-check-input" id="billtoship">
			<label class="form-check-label" for="billtoship">Göndərilmə ünvanı ilə yaşadığınız ünvan eynidirsə seçin</label>
		</div>
	</div>
</div>
</div>
</div>

<div class="col-sm-12 col-lg-6">
<div class="contact-form-right">
<h3><div id="daxil">Göndərmək</div></h3>
<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif name="shipping_name" id="shipping_name" class="form-control" required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}" @endif name="shipping_address" id="shipping_address" class="form-control" required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif name="shipping_city" id="shipping_city" class="form-control" required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif name="shipping_state" id="shipping_state" class="form-control" required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<select id="shipping_country" name="shipping_country" class="form-control">
				<option>Ölkə seçin</option>
				@foreach($countries as $country)
				   <option value="{{$country->countryname}}" @if(!empty($userDetails->country) && $country->countryname == $userDetails->country) selected @endif>{{$country->countryname}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="text" @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif name="shipping_pincode" id="shipping_pincode" class="form-control" required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="form-group">
			<input type="number" @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif name="shipping_mobile" id="shipping_mobile" class="form-control" required>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="submit-button text-right">
			<button class="btn hvr-hover" id="submit" type="submit">Yoxlamaq</button>
			<div id="msgSubmit" class="h3 text-right hidden"></div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>	
</div>
</div>
</div>
</form>
</div>
</div>
</div>
@endsection