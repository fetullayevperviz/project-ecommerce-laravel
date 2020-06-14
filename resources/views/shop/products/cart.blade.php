@extends('shop.layouts.master')
@section('title','Ecommerce Səbət')
@section('content')
<!-- Start Cart  -->
{{--@if($userCart->count()>0)--}}
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
                <th style="text-align:center;">Sil</th>
            </tr>
        </thead>
        <tbody>
            <?php $total_amount = 0;?>
            @foreach($userCart as $cart)
              <tr style="text-align:center;">
                <td class="thumbnail-img">
	                <a href="#">
						<img class="img-fluid" src="{{asset('/uploads/product/'.$cart->image)}}"/>
					</a>
	            </td>
	            <td class="name-pr">
					{{$cart->product_name}}
                    <p>Məhsul kodu : {{$cart->product_code}}</p>
                    <p>Ölçü : {{$cart->size}}</p>
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
	                <p>{{number_format(($cart->price)*($cart->quantity),2)}} AZN</p>
	            </td>
	            <td class="remove-pr">
	                <a href="{{url('/cart/delete-product/'.$cart->id)}}">
				       <i class="fas fa-times"></i>
					</a>
                </td>
            </tr>
            <?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>

<div class="row my-5">
<div class="col-lg-6 col-sm-6">
<div class="coupon-box">
    <form action="{{url('/cart/apply-coupon')}}" method="post">
        @csrf
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Kupon kodunu yazın">
          <div class="input-group-append">
            <button class="btn btn-theme" type="submit">Kupon tətbiq edin</button>
          </div>
        </div>
  </form>
</div>
</div>
<div class="col-lg-6 col-sm-6">
 <div class="order-box">
    <h2 style="text-align:center;">Sifariş</h2>
    @if(!empty(Session::get("CouponAmount")))
    <div class="d-flex">
        <h4>Ümumi hesab</h4>
        <div class="ml-auto font-weight-bold"> <?php echo number_format($total_amount,2);?> AZN</div>
    </div>
    <hr class="my-1">
    <div class="d-flex">
        <h4>Kupon endirimi</h4>
        <div class="ml-auto font-weight-bold"> <?php echo number_format(Session::get("CouponAmount"),2);?> AZN</div>
    </div>
    <hr>
    <div class="d-flex gr-total">
        <h5>Son hesab</h5>
        <div class="ml-auto h5"> <?php echo number_format($total_amount - (Session::get("CouponAmount")),2);?> AZN</div>
    </div>
    <hr>
    @else
    <div class="d-flex gr-total">
        <h5>Son hesab</h5>
        <div class="ml-auto h5"> <?php echo number_format($total_amount,2);?> AZN</div>
    </div>
    @endif
</div>
<div class="col-12 d-flex shopping-box">
    <a href="{{url('/checkout')}}" class="ml-auto btn hvr-hover">Yoxlamaq</a> 
</div>
</div>
</div>

</div>
</div>
{{--@else
<h1 style="text-align:center;color:red;font-size:50px;font-weight:bold;margin-top:200px;margin-bottom:200px;">Səbətə məhsul əlavə edilməyib</h1>
@endif--}}
<!-- End Cart -->
@endsection