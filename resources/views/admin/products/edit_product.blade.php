@extends('admin.layouts.master')
@section('title','Məhsulu redaktə et')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-product-hunt"></i>
   </div>
   <div class="header-title">
      <h1>Məhsulu Redaktə Et</h1>
      <small>Məhsulu Redaktə Et</small>
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
                  <a class="btn btn-add " href="{{url('admin/view-products')}}"> 
                  <i class="fa fa-eye"></i> Məhsulları Göstər</a>  
               </div>
            </div>
            <div class="panel-body">
               <form action="{{url('/admin/edit-product/'.$productDetails->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Kateqoriya</label>
                           <select name="category_id" id="category_id" class="form-control">
                              <?php echo $categories_dropdown; ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                         <div class="form-group">
                           <label>Cins</label>
                           <select name="gender" id="gender" class="form-control" required>
                               @if($productDetails->gender=="0")
                                 <option value="0" selected>Qadın</option>
                                 <option value="1">Kişi</option>
                                 <option value="2">Qadın və Kişi</option>
                                 @elseif($productDetails->gender=="1")
                                 <option value="0">Qadın</option>
                                 <option value="1" selected>Kişi</option>
                                 <option value="2">Qadın və Kişi</option>
                                 @else
                                 <option value="0">Qadın</option>
                                 <option value="1">Kişi</option>
                                 <option value="2" selected>Qadın və Kişi</option>
                                @endif
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Fəsil</label>
                           <select name="chapter" id="chapter" class="form-control" required>
                               @if($productDetails->chapter==0)
                                 <option value="0" selected>Qış</option>
                                 <option value="1">Yaz</option>
                                 <option value="2">Yay</option>
                                 <option value="3">Payız</option>
                                 <option value="4">Bütün fəsillər</option>
                                 @elseif($productDetails->chapter==1)
                                 <option value="0">Qış</option>
                                 <option value="1" selected>Yaz</option>
                                 <option value="2">Yay</option>
                                 <option value="3">Payız</option>
                                 <option value="4">Bütün fəsillər</option>
                                 @elseif($productDetails->chapter==2)
                                 <option value="0">Qış</option>
                                 <option value="1">Yaz</option>
                                 <option value="2" selected>Yay</option>
                                 <option value="3">Payız</option>
                                 <option value="4">Bütün fəsillər</option>
                                 @elseif($productDetails->chapter==3)
                                 <option value="0">Qış</option>
                                 <option value="1">Yaz</option>
                                 <option value="2">Yay</option>
                                 <option value="3" selected>Payız</option>
                                 <option value="4">Bütün fəsillər</option>
                                 @else
                                 <option value="0">Qış</option>
                                 <option value="1">Yaz</option>
                                 <option value="2">Yay</option>
                                 <option value="3">Payız</option>
                                 <option value="4" selected="">Bütün fəsillər</option>
                                @endif
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Məhsul adı</label>
                           <input type="text" class="form-control" value="{{$productDetails->product_name}}" name="product_name" id="product_name" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Məhsulun kodu</label>
                           <input type="text" class="form-control" value="{{$productDetails->product_code}}" name="product_code" id="product_code" required>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Məhsulun rəngi</label>
                           <input type="text" class="form-control" value="{{$productDetails->product_color}}" name="product_color" id="product_color" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-froup">
                            <label>Məhsulun mövcud şəkili</label><br>
                            <img src="{{asset('/uploads/product/'.$productDetails->image)}}" style="width:100px;height:100px;object-fit:cover;">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Məhsul haqqında açıqlama</label>
                           <textarea class="form-control" placeholder="Məhsul haqqında açıqlama yazın" name="product_description" id="product_description" rows="5" required>{{$productDetails->product_description}}</textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Məhsulun şəkili</label>
                           <input type="file" name="image" id="image" class="form-control">
                           <input type="hidden" name="current_image" value="{{$productDetails->image}}">
                        </div>
                     </div>
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Məhsulun qiyməti</label>
                           <input type="text" class="form-control" value="{{$productDetails->product_price}}" name="product_price" id="product_price" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                              @if($productDetails->status == 0)
                                <option value="0" selected>Passiv</option>
                                <option value="1">Aktiv</option>
                                @else
                                <option value="0">Passiv</option>
                                <option value="1" selected>Aktiv</option>
                              @endif
                            </select>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label></label> <br>
                            <input type="submit" style="float:right;" name="product_submit" class="btn btn-success" value="Yenilə">
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