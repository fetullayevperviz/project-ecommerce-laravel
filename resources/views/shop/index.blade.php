@extends('shop.layouts.master')
@section('title','Ecommerce')
@section('content')
<!-- Start Slider -->
<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        @foreach($banners as $banner)
        <li class="{{$banner->text_style}}">
            <img src="{{asset('/uploads/banners/'.$banner->image)}}" alt="{{$banner->name}}">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>{{$banner->name}}</strong></h1>
                        <p class="m-b-40">{{$banner->content}}</p>
                        <p><a class="btn hvr-hover" href="{{$banner->link}}">YENİ</a></p>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->
<!-- Start Shop Page  -->
<div class="shop-box-inner">
<div class="container">
<div class="row">
<div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
<div class="product-categori">
<div class="search-product">
    <form action="#">
        <input class="form-control" placeholder="Search here..." type="text">
        <button type="submit"> <i class="fa fa-search"></i> </button>
    </form>
</div>
<div class="filter-sidebar-left">
    <div class="title-left">
        <h3>Kateqoriyalar</h3>
    </div>
    <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
        @foreach($categories as $category)
            <div class="list-group-collapse sub-men">
              <a class="list-group-item list-group-item-action" href="#{{$category->id}}" data-toggle="collapse" aria-expanded="true" aria-controls="sub-men1">{{$category->category_name}}</small>
            </a>
            <div class="collapse show" id="{{$category->id}}" data-parent="#list-group-men">
              <div class="list-group">
                 @foreach($category->categories as $sub_cat)
                   <a href="{{url('/categories/'.$sub_cat->id).'/'.$sub_cat->url}}" class="list-group-item list-group-item-action active">{{$sub_cat->category_name}} <!--<small class="text-muted">()</small>--></a>
                 @endforeach
              </div>
            </div>
            </div>
        @endforeach
    </div>
</div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
<div class="right-product-box">
<div class="product-item-filter row">
    <div class="col-12 col-sm-8 text-center text-sm-left"></div>
    <div class="col-12 col-sm-4 text-center text-sm-right">
        <ul class="nav nav-tabs ml-auto">
            <li>
                <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
            </li>
        </ul>
    </div>
</div>
<div class="row product-categorie-box">
<div class="tab-content">
<div role="tabpanel" class="tab-pane fade show active" id="grid-view">
<div class="row">
@foreach($products as $product)
  <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
    <div class="products-single fix">
        <div class="box-img-hover">
            <div class="type-lb">
                <p class="sale">YENİ</p>
            </div>
            <img src="{{asset('/uploads/product/'.$product->image)}}" style="object-fit:cover;height:265px;" class="img-fluid" alt="Image">
            <div class="mask-icon">
                <ul>
                    <li>
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Görüntülə">
                            <i class="fas fa-eye"></i></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Qarşılaşdır">
                            <i class="fas fa-sync-alt"></i></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Siyahıya əlavə et">
                            <i class="far fa-heart"></i></a>
                    </li>
                </ul>
                <a class="cart" href="{{url('/products/'.$product->id)}}">Ətraflı oxu</a>
            </div>
        </div>
        <div class="why-text">
            <h4>{{$product->product_description}}</h4>
            <h5> {{$product->product_price}} AZN</h5>
        </div>
    </div>
  </div>
@endforeach
</div>
</div>
</div>
</div>
{{$products->links()}}
</div>
</div>
</div>
</div>
</div>
<!-- End Shop Page -->

<!-- Start Instagram Feed  -->
<div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-01.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-02.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-03.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-04.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-05.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-06.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-07.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-08.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-09.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{asset('/front_assets/')}}/images/instagram-img-05.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Instagram Feed  -->
@endsection