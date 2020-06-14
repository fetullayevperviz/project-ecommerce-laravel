@extends('admin.layouts.master')
@section('title','Sifarişlər Listi')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-image"></i>
   </div>
   <div class="header-title">
      <h1>Sifarişlər</h1>
      <small>Sifariş Listi</small>
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
                     <h4>Sifarişlər Cədvəli</h4>
                  </a>
               </div>
            </div>
            <div class="panel-body">
            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="btn-group">
                  <div class="buttonexport" id="buttonlist"> 
                     <span id="message_success" style="display:none;width:300px;text-align:center;margin-left:250px;" class="alert alert-success">Status Aktiv Edildi</span>
                     <span id="message_error" style="display:none;width:300px;text-align:center;margin-left:250px;" class="alert alert-danger">Status Passiv Edildi</span>
                  </div>
               </div>
               <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
               <div class="table-responsive">
                  <table id="products_table" class="table table-bordered table-striped table-hover">
                     <thead>
                        <tr>
                           <th style="text-align:center;">Sifariş ID</th>
                           <th style="text-align:center;">Sifariş tarixi</th>
                           <th style="text-align:center;">Müştəri adı</th>
                           <th style="text-align:center;">Müştəri emaili</th>
                           <th style="text-align:center;">Sifariş olunmuş məhsul</th>
                           <th style="text-align:center;">Ümumi hesab</th>
                           <!--<th style="text-align:center;">Sifariş statusu</th>
                           <th style="text-align:center;">Sifariş üsulu</th>-->
                           <th style="text-align:center;">Əməliyyatlar</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($orders as $order)
                        <tr>
                           <td style="text-align:center;">{{$order->id}}</td>
                           <td style="text-align:center;">{{$order->created_at}}</td>
                           <td style="text-align:center;">{{$order->name}}</td>
                           <td style="text-align:center;">{{$order->user_email}}</td>
                           <td style="text-align:center;">
                              @foreach($order->orders as $pro)
                                Kod : {{$pro->product_code}} <br>
                                Say : ({{$pro->product_quantity}}) <br>
                              @endforeach
                           </td>
                           <td style="text-align:center;">{{number_format($order->grand_total,2)}} AZN</td>
                           {{--<td style="text-align:center;">{{$order->order_status}}</td>
                           <td style="text-align:center;">{{$order->payment_method}}</td>--}}
                           <td style="text-align:center;">
                              <a href="{{url('/admin/view-order/'.$order->id)}}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i>&nbsp; Görüntülə</a><br><br>
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