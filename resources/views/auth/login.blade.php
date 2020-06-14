@extends('shop.layouts.master')
@section('title','Ecommerce Giriş və Qeyd ol')
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
            <div class="col-sm-12 col-lg-5">
                <div class="contact-form-right">
                    <h3><div id="qeydiyyat">Qeyd olmaq</div></h3>
                    <form action="{{url('/user-register')}}" method="POST" id="contactForm registerForm" autocomplete="off">
                     @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="ad soyadınızı yazın" required data-error="Zəhmət olmasa ad soyadınızı yazın">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="emailinizi yazın" required data-error="Zəhmət olmasa emailinizi yazın">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="şifrənizi yazın" required data-error="Zəhmət olmasa şifrənizi yazın">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="submit-button text-right">
                                    <button class="btn hvr-hover" id="submit" type="submit">Qeyd ol</button>
                                    <div id="msgSubmit" class="h3 text-right hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-lg-1" id="or">
                və ya
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="contact-form-right">
                    <h3><div id="daxil">Daxil olmaq</div></h3>
                    <form action="{{url('/user-login')}}" method="post" id="contactForm LoginForm" autocomplete="off">
                     @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="emailinizi yazın" required data-error="Zəhmət olmasa emailinizi yazın">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="şifrənizi yazın" required data-error="Zəhmət olmasa şifrənizi yazın">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="submit-button text-right">
                                    <button class="btn hvr-hover" id="submit" type="submit">Daxil ol</button>
                                    <div id="msgSubmit" class="h3 text-right hidden"></div>
                                    <div class="clearfix"></div>
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