<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- sidebar -->
<div class="sidebar">
   <!-- sidebar menu -->
   <ul class="sidebar-menu">
      <li class="active">
         <a href="{{url('/admin/dashboard')}}">
            <i class="fa fa-home"></i>
            <span>Ana Səhifə</span>
            <span class="pull-right-container"></span>
         </a>
      </li>
      <li>
         <a href="{{url('admin/banners')}}">
            <i class="fa fa-image"></i>
            <span>Bannerlər</span>
            <span class="pull-right-container"></span>
         </a>
      </li> 
      <li class="treeview">
         <a href="">
         <i class="fa fa-list"></i><span>Kateqoriyalar</span>
         <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
         </span>
         </a>
         <ul class="treeview-menu">
            <li><a href="{{url('admin/add-category')}}">Kateqoriya əlavə et</a></li>
            <li><a href="{{url('admin/view-categories')}}">Kateqoriyaları göstər</a></li>
         </ul>
      </li>
      <li class="treeview">
         <a href="">
         <i class="fa fa-product-hunt"></i><span>Məhsullar</span>
         <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
         </span>
         </a>
         <ul class="treeview-menu">
            <li><a href="{{url('admin/add-product')}}">Məhsul əlavə et</a></li>
            <li><a href="{{url('admin/view-products')}}">Məhsulları göstər</a></li>
         </ul>
      </li>
      <li class="treeview">
         <a href="">
         <i class="fa fa-gift"></i><span>Kuponlar</span>
         <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
         </span>
         </a>
         <ul class="treeview-menu">
            <li><a href="{{url('admin/add-coupon')}}">Kupon əlavə et</a></li>
            <li><a href="{{url('admin/view-coupons')}}">Kuponları göstər</a></li>
         </ul>
      </li>
   </ul>
</div>
<!-- /.sidebar -->
</aside>