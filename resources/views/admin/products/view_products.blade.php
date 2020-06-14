@extends('admin.layouts.master')
@section('title','Məhsullar Listi')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-product-hunt"></i>
   </div>
   <div class="header-title">
      <h1>Məhsullar</h1>
      <small>Məhsullar Listi</small>
   </div>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-sm-12">
         <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
               <div class="btn-group" id="buttonexport">
                  <a href="#">
                     <h4>Məhsullar Cədvəli</h4>
                  </a>
               </div>
            </div>
            <div class="panel-body">
            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="btn-group">
                  <div class="buttonexport" id="buttonlist"> 
                     <a class="btn btn-add" href="{{url('admin/add-product')}}"> <i class="fa fa-plus"></i> Əlavə et
                     </a>
                     <span id="message_success" style="display:none;width:300px;text-align:center;margin-left:250px;" class="alert alert-success">Status Aktiv Edildi</span>
                     <span id="message_error" style="display:none;width:300px;text-align:center;margin-left:250px;" class="alert alert-danger">Status Passiv Edildi</span>
                  </div>
               </div>
               <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="table-responsive">
                  <table id="products_table" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr class="info">
                           <th style="text-align:center;">Şəkili</th>
                           <th style="text-align:center;">Məhsulun adı</th>
                           <th style="text-align:center;">Kod</th>
                           <th style="text-align:center;">Qiymət</th>
                           <th style="text-align:center;">Rəng</th>
                           <th style="text-align:center;">Xüsusilik</th>
                           <th style="text-align:center;">Status</th>
                           <th style="text-align:center;">Əməliyyatlar</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($products as $product)
                        <tr>
                           <td style="text-align:center;">
                              @if(!empty($product->image))
                                 <img src="{{asset('/uploads/product/'.$product->image)}}" alt="{{$product->product_name}}" width="80" height="80">
                                 @else
                                  {{$product->product_name}}
                              @endif 
                           </td>
                           <td style="text-align:center;">{{$product->product_name}}</td>
                           <td style="text-align:center;">{{$product->product_code}}</td>
                           <td style="text-align:center;">{{number_format($product->product_price,2)}} AZN</td>
                           <td style="text-align:center;">{{$product->product_color}}</td>
                           <td style="text-align:center;">
                              <input type="checkbox" class="FeaturedStatus btn btn-success" rel="{{$product->id}}" data-toggle="toggle" data-on="Aktiv" data-off="Passiv" data-onstyle="success" data-offstyle="danger" @if($product->featured_products==1) checked @endif>
                              <div id="myElem" style="display:none;" class="alert alert-success">Aktiv</div>
                           </td>
                           <td style="text-align:center;">
                           	<input type="checkbox" class="ProductStatus btn btn-success" rel="{{$product->id}}" data-toggle="toggle" data-on="Aktiv" data-off="Passiv" data-onstyle="success" data-offstyle="danger" @if($product->status==1) checked @endif>
                              <div id="myElem" style="display:none;" class="alert alert-success">Aktiv</div>
                           </td>
                           <td style="text-align:center;">
                               <a href="{{url('/admin/add-images/'.$product->id)}}" class="btn btn-info btn-sm text-white" title="Şəkil əlavə et">
                                 <i class="fa fa-image"></i>
                               </a>
                               <a href="{{url('/admin/add-attributes/'.$product->id)}}" class="btn btn-primary btn-sm text-white" title="Atribut əlavə et">
                                 <i class="fa fa-list"></i>
                               </a>
                               <a href="{{url('/admin/edit-product/'.$product->id)}}" class="btn btn-success btn-sm text-white" title="Məhsulu redaktə et">
                                 <i class="fa fa-pencil"></i>
                               </a>
                              <a href="{{url('/admin/delete-product/'.$product->id)}}" class="btn btn-danger btn-sm text-white" title="Məhsulu sil">
                                 <i class="fa fa-trash-o"></i>
                              </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
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