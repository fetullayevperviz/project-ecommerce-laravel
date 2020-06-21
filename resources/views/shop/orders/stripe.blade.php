@extends('shop.layouts.master')
@section('title','Ecommerce Sifariş cavabı')
@section('content')

<div class="cart-box-main">
    <div class="container">
        {{--@if(Session::has('flash_message_error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>{{session('flash_message_error')}}</strong>
        </div>
        @endif
        @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            <strong>{{session('flash_message_success')}}</strong>
        </div>
        @endif--}}
        <h1 align="center">Bizdən satın aldığınız üçün təşəkkür edirik!</h1> <br><br>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div align="center">
                    <h2>Sifarişiniz qeydə alınıb</h2>
                    <p>Sifariş nömrəniz {{Session::get('order_id')}} və ümumi ödəmə haqqı {{number_format(Session::get('grand_total'),2)}} AZN-dir</p>
                    <b>Zəhmət olmasa kredit və ya debit kartınızı daxil edərək ödəniş edin</b>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <!--Ödəniş metodu forması-->
                <script src="https://js.stripe.com/v3/"></script>
                <form action="/stripe" method="post" id="payment-form">
                    @csrf
                  <div class="form-row">
                    <b>Ümumi ödəniləcək məbləğ</b>
                    <input type="text" name="total_amount" placeholder="ümumi ödəniləcək məbləği yazın" class="form-control">
                    <b>Ad Soyadınız</b>
                    <input type="text" name="name" placeholder="ad soyadınızı yazın" class="form-control">
                    <b>Kart nömrəsi</b>
                    <div id="card-element" class="form-control"></div>
                  </div>
                  <button class="btn btn-success btn-sm" style="float:right;margin-top:10px;">Submit Payment</button>
                </form>
                <div id="card-error" role='alert'></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Create a Stripe client.
var stripe = Stripe('pk_test_51GwPt4Bk6mfSIEFwa7sWX7S0xW77NIUHxqhTaHsBOi5fMre8JXubEiaSP7SwPWRXiNUwS5TGI6wtEisbxOPkmtCL00mablAUnD');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>

@endsection

<?php 
    Session::forget('order_id');
    Session::forget('grand_total');
 ?>