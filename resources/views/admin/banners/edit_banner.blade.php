@extends('admin.layouts.master')
@section('title','Banneri redaktə et')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-image"></i>
   </div>
   <div class="header-title">
      <h1>Banneri redaktə et</h1>
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
               <form action="{{url('/admin/edit-banner/'.$bannerDetails->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Banner adı</label>
                           <input type="text" name="name" class="form-control" value="{{$bannerDetails->name}}">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                         <div class="form-group">
                           <label>Banner linki</label>
                           <input type="text" name="link" class="form-control" value="{{$bannerDetails->link}}">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Yazı istiqaməti</label>
                           <input type="text" name="text_style" class="form-control" value="{{$bannerDetails->text_style}}">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Banner sırası</label>
                           <input type="number" name="sort_order" class="form-control" value="{{$bannerDetails->sort_order}}" required>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                          <label>Banner şəkili</label>
                          <input type="file" name="image" class="form-control">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Status</label>
                           <select name="status" class="form-control">
                              @if($bannerDetails->status==0)
                                <option value="0" selected>Passiv</option>
                                <option value="1">Aktiv</option>
                                @else
                                <option value="0">Passiv</option>
                                <option value="1" selected>Aktiv</option>
                              @endif
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Bannerin mövcud şəkili</label><br>
                           @if(!empty($bannerDetails->image))
                            <input type="hidden" name="current_image" value="{{$bannerDetails->image}}">
                            <img src="{{asset('/uploads/banners/'.$bannerDetails->image)}}" style="width:470px;height:115px;object-fit:cover;">
                           @endif
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Banner haqqında məlumat</label>
                           <textarea class="form-control" placeholder="Banner haqqında məlumat yazın" name="content" rows="5" required>{{$bannerDetails->content}}</textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <input type="submit" style="float:right;" name="banner_update" class="btn btn-success" value="Redaktə et">
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