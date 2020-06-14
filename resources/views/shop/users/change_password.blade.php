@extends('shop.layouts.master')
@section('title','Ecommerce Şifrəni dəyişdir')
@section('content')
<div class="contact-box-main">
<div class="container">
	<div class="row">
    @if($errors->any())
       <div class="alert alert-danger">
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
       </div>
   @endif
   <div class="col-md-3"></div>
		<div class="col-sm-12 col-md-6">
			<div class="contact-form-right">
				<h3><div id="qeydiyyat">Şifrəni dəyişdir</div></h3>
				<form action="{{url('/change-password')}}" method="POST" id="contactForm registerForm" autocomplete="off">
            @csrf
					<div class="row">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <input type="hidden" name="old_password" id="old_password">
                     </div>
                  </div>
						<div class="col-sm-12">
							<div class="form-group">
								<input type="password" name="current_password" id="current_password" class="form-control" placeholder="köhnə şifrənizi yazın" required data-error="Zəhmət olmasa köhnə şifrənizi yazın">
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<input type="password" name="new_password" id="new_password" class="form-control" placeholder="yeni şifrənizi yazın" required data-error="Zəhmət olmasa yeni şifrənizi yazın">
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
				</form>
			</div>
		</div>
   <div class="col-md-3"></div>
	</div>
</div>
</div>
@endsection