@extends('admin.layouts.master')
@section('title','Kateqoriya əlavə et')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-edit"></i>
   </div>
   <div class="header-title">
      <h1>Kateqoriya əlavə et</h1>
      <small>Kateqoriyalar</small>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      @if($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" style="color:white;" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>
               @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
               @endforeach
            </strong>
         </div>
      @endif
      <!-- Form controls -->
      <div class="col-sm-12">
         <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
               <div class="btn-group" id="buttonlist"> 
                  <a class="btn btn-add " href="{{url('admin/view-categories')}}"> 
                  <i class="fa fa-eye"></i> Kateqoriyaları Göstər</a>  
               </div>
            </div>
            <div class="panel-body">
               <form action="{{url('/admin/add-category')}}" method="post">
                  @csrf
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Kateqoriya adı</label>
                           <input type="text" class="form-control" placeholder="Kateqoriya adını yazın" name="category_name" id="category_name">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Üst kateqoriyası</label>
                           <select name="parent_id" id="parent_id" class="form-control">
                              <option value="0">Üst kateqoriya</option>
                              @foreach($levels as $val)
                                <option value="{{$val->id}}">{{$val->category_name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                         <div class="form-group">
                           <label>Kateqoriya haqqında açıqlama</label>
                           <textarea class="form-control" placeholder="Kateqoriya haqqında açıqlama yazın" name="description" id="description" rows="5"></textarea>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Kateqoriya url</label>
                           <input type="text" class="form-control" placeholder="Kateqoriya url-ni yazın" name="url" id="url"><br><br><br>
                           <input type="submit" style="float:right;" name="category_submit" class="btn btn-success" value="Əlavə et">
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