@extends('admin.layouts.master')
@section('title','Məhsul atributları əlavə et')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-product-hunt"></i>
   </div>
   <div class="header-title">
      <h1>Məhsul atributları əlavə et</h1>
      <small>Məhsul atributları</small>
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
               <form action="{{url('/admin/add-attributes/'.$productDetails->id)}}" method="post" enctype="multipart/form-data" class="col-sm-12 col-md-6 col-lg-6">
                  @csrf     
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
                    <div class="field_wrapper">
                        <div style="display:flex;">
                            <input type="text" name="sku[]" id="sku" placeholder="Ölçü kodu yazın" class="form-control" style="width:115px;"/>&nbsp;&nbsp;
                            <input type="text" name="size[]" id="size" placeholder="Ölçüsünü yazın" class="form-control" style="width:115px;"/>&nbsp;&nbsp;
                            <input type="text" name="price[]" id="price" placeholder="Qiymətini yazın" class="form-control" style="width:115px;"/>&nbsp;&nbsp;
                            <input type="text" name="stock[]" id="stock" placeholder="Sayını yazın" class="form-control" style="width:115px;"/>&nbsp;
                            <a href="javascript:void(0);" class="add_button btn btn-success" title="Əlavə et">Artır</a>
                        </div><br>
                    </div>
                  </div>   
                  <div class="form-group">
                      <input type="submit" style="float:right;width:100px;" name="attribute_submit" class="btn btn-primary" value="Əlavə et">
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
                     <h4>Atributlar Cədvəli</h4>
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
                <form action="{{url('/admin/edit-attributes/'.$productDetails->id)}}" method="post" enctype="multipart/form-data"> @csrf
                  <table id="products_table" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr class="info">
                           <th style="text-align:center;">Kateqoriya ID</th>
                           <th style="text-align:center;">Məhsul ID</th>
                           <th style="text-align:center;">Ölçü kodu</th>
                           <th style="text-align:center;">Ölçü</th>
                           <th style="text-align:center;">Qiymət</th>
                           <th style="text-align:center;">Say</th>
                           <th style="text-align:center;">Əməliyyatlar</th>
                        </tr>
                     </thead>
                     <tbody>
                       @foreach($productDetails['attributes'] as $attribute)
                        <tr>
                           <td style="display:none;">
                             <input type="hidden" name="attr[]" value="{{$attribute->id}}">
                           </td>
                           <td style="text-align:center;">
                              {{$attribute->id}}
                            </td>
                           <td style="text-align:center;">
                              {{$attribute->product_id}}
                           </td>
                           <td style="text-align:center;">
                              <input type="text" name="sku[]" style="text-align:center;width:100px;" value="{{$attribute->sku}}">
                           </td>
                           <td style="text-align:center;">
                              <input type="text" name="size[]" style="text-align:center;width:100px;" value="{{$attribute->size}}">
                           </td>
                           <td style="text-align:center;">
                              <input type="text" name="price[]" style="text-align:center;width:100px;" value="{{$attribute->price}}">
                           </td>
                           <td style="text-align:center;">
                              <input type="text" name="stock[]" style="text-align:center;width:100px;" value="{{$attribute->stock}}">
                           </td>
                           <td style="text-align:center;">
                             <button type="submit" class="btn btn-success btn-sm text-white">
                               <i class="fa fa-edit"></i>
                             </button>&nbsp;&nbsp;
                             <a href="{{url('/admin/delete-attribute/'.$attribute->id)}}" class="btn btn-danger btn-sm text-white">
                             <i class="fa fa-trash-o"></i>
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