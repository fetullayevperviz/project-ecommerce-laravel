@extends('admin.layouts.master')
@section('title','Banner Listi')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-image"></i>
   </div>
   <div class="header-title">
      <h1>Bannerlər</h1>
      <small>Bannerlər Listi</small>
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
                     <h4>Bannerlər Cədvəli</h4>
                  </a>
               </div>
            </div>
            <div class="panel-body">
            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="btn-group">
                  <div class="buttonexport" id="buttonlist"> 
                     <a class="btn btn-add" href="{{url('admin/add-banner')}}"> <i class="fa fa-plus"></i> Əlavə et
                     </a>
                     <span id="message_success" style="display:none;width:300px;text-align:center;margin-left:250px;" class="alert alert-success">Status Aktiv Edildi</span>
                     <span id="message_error" style="display:none;width:300px;text-align:center;margin-left:250px;" class="alert alert-danger">Status Passiv Edildi</span>
                  </div>
               </div>
               <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="table-responsive">
                  <table id="products_table" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr>
                           <th style="text-align:center;">ID</th>
                           <th style="text-align:center;">Şəkil</th>
                           <th style="text-align:center;">Banner adı</th>
                           <th style="text-align:center;">Sıralama</th>
                           <th style="text-align:center;">Link</th>
                           <th style="text-align:center;">Status</th>
                           <th style="text-align:center;">Əməliyyatlar</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($banners as $banner)
                        <tr>
                           <td style="text-align:center;">{{$banner->id}}</td>
                           <td style="text-align:center;">
                              @if(!empty($banner->image))
                                 <img src="{{asset('/uploads/banners/'.$banner->image)}}" alt="{{$banner->name}}" width="200" height="100">
                                 @else
                                  {{$banner->name}}
                              @endif 
                           </td>
                           <td style="text-align:center;">{{$banner->name}}</td>
                           <td style="text-align:center;">{{$banner->sort_order}}</td>
                           <td style="text-align:center;">{{$banner->link}}</td>
                           <td style="text-align:center;">
                              <input type="checkbox" class="BannerStatus btn btn-success" rel="{{$banner->id}}" data-toggle="toggle" data-on="Aktiv" data-off="Passiv" data-onstyle="success" data-offstyle="danger" @if($banner->status==1) checked @endif>
                              <div id="myElem" style="display:none;" class="alert alert-success">Aktiv</div>
                           </td>
                           <td style="text-align:center;">
                               <a href="{{url('/admin/edit-banner/'.$banner->id)}}" class="btn btn-primary btn-sm text-white">
                                 <i class="fa fa-pencil"></i>
                              </a>
                              <a href="{{url('/admin/delete-banner/'.$banner->id)}}" class="btn btn-danger btn-sm text-white">
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