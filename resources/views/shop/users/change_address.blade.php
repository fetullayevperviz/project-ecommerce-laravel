@extends('shop.layouts.master')
@section('title','Ecommerce Profili redaktə et')
@section('content')
<div class="contact-box-main">
 <div class="container">
 	<div class="row">
 		<div class="col-sm-12 col-md-12">
 			<div class="contact-form-right">
 				<h3><div id="qeydiyyat">Profili redaktə et</div></h3>
 				<form action="{{url('/change-address')}}" method="POST" id="contactForm registerForm" autocomplete="off">
               @csrf
 					<div class="row">
                  <div class="col-md-6">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <input type="text" name="name" id="name" class="form-control" value="{{$userDetails->name}}" required data-error="Zəhmət olmasa ad soyadınızı yazın">
                           <div class="help-block with-errors"></div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <input type="text" name="address" id="address" class="form-control" value="{{$userDetails->address}}" required data-error="Zəhmət olmasa ünvanınızı yazın">
                           <div class="help-block with-errors"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <input type="text" name="city" id="city" class="form-control" value="{{$userDetails->city}}" required data-error="Zəhmət olmasa şəhər adını yazın">
                           <div class="help-block with-errors"></div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <input type="text" name="state" id="state" class="form-control" value="{{$userDetails->state}}" required data-error="Zəhmət olmasa dövlət adını yazın">
                           <div class="help-block with-errors"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <select name="country" id="country" class="form-control" data-error="Zəhmət olmasa ölkə seçin">
                              <option value>Ölkə seçin</option>
                              @foreach($countries as $country)
                                <option class="{{$country->countryname}}" @if($country->countryname == $userDetails->country) selected @endif>{{$country->countryname}}</option>
                              @endforeach
                           </select>
                           <div class="help-block with-errors"></div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <input type="text" name="pincode" id="pincode" class="form-control" value="{{$userDetails->pincode}}" required data-error="Zəhmət olmasa pin şifrənizi yazın">
                           <div class="help-block with-errors"></div>
                        </div>
                     </div>
                  </div>
 					  <div class="col-md-6">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <input type="text" name="mobile" id="mobile" class="form-control" value="{{$userDetails->mobile}}" required data-error="Zəhmət olmasa mobil nömrənizi yazın">
                           <div class="help-block with-errors"></div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="submit-button text-right">
                           <button class="btn hvr-hover" id="submit" type="submit">Yadda saxla</button>
                           <div id="msgSubmit" class="h3 text-right hidden"></div>
                           <div class="clearfix"></div>
                        </div>
                     </div>           
                 </div>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>
</div>
@endsection