@extends('admin.layouts.master')
@section('title','Banner əlavə et')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-image"></i>
   </div>
   <div class="header-title">
      <h1>Banner əlavə et</h1>
      <small>Bannerlər</small>
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
                  <a class="btn btn-add " href="{{url('admin/banners')}}"> 
                  <i class="fa fa-eye"></i> Bannerləri Göstər</a>  
               </div>
            </div>
            <div class="panel-body">
               <form action="{{url('/admin/add-banner')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Banner adı</label>
                           <input type="text" name="name" class="form-control" placeholder="Banner adı yazın">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                         <div class="form-group">
                           <label>Banner linki</label>
                           <input type="text" name="link" class="form-control" placeholder="Banner linki yazın">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Yazı istiqaməti</label>
                           <input type="text" name="text_style" class="form-control" placeholder="Yazı istiqamətini yazın (text-left,text-center,text-right)">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Banner sırası</label>
                           <input type="number" class="form-control" placeholder="Banner sırasını yazın" name="sort_order" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Banner haqqında məlumat</label>
                           <textarea class="form-control" placeholder="Banner haqqında məlumat yazın" name="content" rows="5" required></textarea>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label>Banner şəkili</label>
                          <input type="file" name="image" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <input type="submit" style="float:right;" name="banner_submit" class="btn btn-success" value="Əlavə et">
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