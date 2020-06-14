@extends('shop.layouts.master')
@section('title','Ecommerce Hesabım səhifəsi')
@section('content')
<!-- Start My Account  -->
<div class="my-account-box-main">
<div class="container">
   <div class="my-account-page">
      <div class="row">
           <div class="col-md-4 col-sm-12">
               <div class="account-box">
                   <div class="service-box">
                       <div class="service-icon">
                           <a href="{{url('/change-address')}}"> <i class="fa fa-location-arrow"></i> </a>
                       </div>
                       <div class="service-desc">
                           <h4>Profili redaktə et</h4>
                           <p>Profili redaktə et</p>
                       </div>
                   </div>
               </div>
           </div>
            <div class="col-md-4 col-sm-12">
               <div class="account-box">
                   <div class="service-box">
                       <div class="service-icon">
                           <a href="{{url('/orders')}}"><i class="fa fa-gift"></i> </a>
                       </div>
                       <div class="service-desc">
                           <h4>Sifarişlərim</h4>
                           <p>Sifarişləri görüntülə</p>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-md-4 col-sm-12">
               <div class="account-box">
                   <div class="service-box">
                       <div class="service-icon">
                           <a href="{{url('/change-password')}}"><i class="fa fa-lock"></i> </a>
                       </div>
                       <div class="service-desc">
                           <h4>Şifrəni dəyişdir</h4>
                           <p>Şifrəni dəyişdir</p>
                       </div>
                   </div>
               </div>
           </div>
      </div>
      <div class="bottom-box">
          <div class="row">
              
         </div>
      </div>
   </div>
</div>
</div>
<!-- End My Account -->
@endsection