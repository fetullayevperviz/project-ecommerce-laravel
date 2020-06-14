@extends('admin.layouts.master')
@section('title','Kupon əlavə et')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-product-hunt"></i>
   </div>
   <div class="header-title">
      <h1>Kupon əlavə et</h1>
      <small>Kuponlar</small>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      @if($errors->any())
          <div class="alert alert-danger">
             @foreach($errors->all() as $error)
               <li>{{$error}}</li>
             @endforeach
          </div>
      @endif
      <!-- Form controls -->
      <div class="col-sm-12">
         <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
               <div class="btn-group" id="buttonlist"> 
                  <a class="btn btn-add " href="{{url('admin/view-coupons')}}"> 
                  <i class="fa fa-eye"></i> Kuponları Göstər</a>  
               </div>
            </div>
            <div class="panel-body">
               <form action="{{url('/admin/add-coupon')}}" autocomplete="off" name="add_coupon" id="add_coupon" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                     <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                           <label>Məbləğ</label>
                           <input type="text" class="form-control" placeholder="Məbləği yazın" name="amount" id="amount" required>
                        </div>
                     </div>
                      <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                           <label>Məbləğ növü</label>
                           <select name="amount_type" id="amount_type" class="form-control">
                               <option value="Faiz">Faiz</option>
                               <option value="Sabit">Sabit</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                           <label>Son istifadə tarixi</label>
                           <input type="text" class="form-control"  name="expiry_date" id="datepicker" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <input type="submit" style="float:right;" name="coupon_submit" class="btn btn-success" value="Əlavə et">
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection