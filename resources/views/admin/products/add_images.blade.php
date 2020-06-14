@extends('admin.layouts.master')
@section('title','Məhsul şəkilləri əlavə et')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-product-hunt"></i>
   </div>
   <div class="header-title">
      <h1>Məhsul şəkilləri əlavə et</h1>
      <small>Məhsul şəkilləri</small>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      {{--@if($errors->any())
          <div class="alert alert-danger">
             @foreach($errors->all() as $error)
               <li>{{$error}}</li>
             @endforeach
          </div>
      @endif--}}
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
               <form action="{{url('/admin/add-images/'.$productDetails->id)}}" method="post" enctype="multipart/form-data" class="col-sm-12 col-md-6 col-lg-6">
                  @csrf     
                  <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                  <div class="form-group">
                     <label style="color:red;">Məhsul adı</label> : <strong>{{$productDetails->product_name}}</strong>
                  </div>
                  <div class="form-group">
                     <label style="color:red;">Məhsulun kodu</label> : <strong>{{$productDetails->product_code}}</strong>
                  </div>               
                  <div class="form-group">
                     <label style="color:red;">Məhsulun rəngi</label> : <strong>{{$productDetails->product_color}}</strong>
                  </div>   
                  <div class="form-group">
                     <label style="color:red;">Məhsulun şəkili</label>
                     <input type="file" name="image[]" id="image" multiple="multiple" class="form-control">
                  </div>        
                    
                  <div class="form-group">
                      <input type="submit" style="float:right;width:100px;" name="images_submit" class="btn btn-primary" value="Əlavə et">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /.content -->

<!--view atributes-->
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-sm-12">
         <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
               <div class="btn-group" id="buttonexport">
                  <a href="#">
                     <h4>Məhsulların Şəkilləri</h4>
                  </a>
               </div>
            </div>
            <div class="panel-body">
            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="btn-group">
                  <div class="buttonexport" id="buttonlist"> 
                     <a class="btn btn-add" href="{{url('admin/add-product')}}"> <i class="fa fa-plus"></i> Məhsul əlavə et
                     </a>
                  </div>
               </div>
               <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="table-responsive">
                <form action="{{url('/admin/edit-images/.$productDetails->id')}}" method="post" enctype="multipart/form-data"> @csrf
                  <table id="products_table" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr class="info">
                           <th style="text-align:center;">ID</th>
                           <th style="text-align:center;">Məhsul ID</th>
                           <th style="text-align:center;">Məhsulun Şəkili</th>
                           <th style="text-align:center;">Əməliyyatlar</th>
                        </tr>
                     </thead>
                     <tbody>
                       @foreach($productImages as $image)
                        <tr>
                           <td style="text-align:center;">
                              {{$image->id}}
                           </td>
                           <td style="text-align:center;">
                              {{$image->product_id}}
                           </td>
                           <td style="text-align:center;">
                             <img src="{{asset('uploads/product/'.$image->image)}}" style="width:100px;height:100px;object-fit:cover;">
                           </td>
                           <td style="text-align:center;">
                             <a href="{{url('/admin/delete-alt-image/'.$image->id)}}" class="btn btn-danger text-white">
                             <i class="fa fa-trash-o"></i>&nbsp; Sil
                             </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection