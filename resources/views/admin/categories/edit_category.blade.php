@extends('admin.layouts.master')
@section('title','Kateqoriyanı redaktə et')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-edit"></i>
   </div>
   <div class="header-title">
      <h1>Kateqoriyanı redaktə et</h1>
      <small>Kateqoriyalar</small>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
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
               <form action="{{url('/admin/edit-category/'.$categoryDetails->id)}}" method="post">
                  @csrf
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Kateqoriya adı</label>
                           <input type="text" class="form-control" value="{{$categoryDetails->category_name}}" name="category_name" id="category_name">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Üst kateqoriyası</label>
                           <select name="parent_id" id="parent_id" class="form-control">
                              <option value="0">Üst kateqoriya</option>
                              @foreach($levels as $val)
                                <option value="{{$val->id}}" @if($val->id==$categoryDetails->parent_id) selected @endif>{{$val->category_name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Kateqoriya url</label>
                           <input type="text" class="form-control" value="{{$categoryDetails->url}}" name="url" id="url">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                           <label>Status</label>
                           <select name="status" class="form-control">
                              @if($categoryDetails->status==0)
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
                     <div class="col-sm-12 col-md-11 col-lg-11">
                         <div class="form-group">
                           <label>Kateqoriya haqqında açıqlama</label>
                           <textarea class="form-control" placeholder="Kateqoriya haqqında açıqlama yazın" name="description" id="description" rows="5">{{$categoryDetails->description}}</textarea>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-1 col-lg-1">
                        <div class="form-group">
                           <label></label><br><br><br><br><br>
                           <input type="submit" style="float:right;" name="category_update" class="btn btn-success" value="Redaktə et">
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