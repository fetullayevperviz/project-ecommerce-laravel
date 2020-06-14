@extends('shop.layouts.master')
@section('title','Məhsul haqqında')
@section('content')
	    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{$productDetails->product_name}}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Yeni</a></li>
                        <li class="breadcrumb-item active">{{$productDetails->product_name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
<div class="container">
<div class="row">
<div class="col-xl-5 col-lg-5 col-md-6">
    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            @foreach($productAltImages as $key=>$images)
                <div class="carousel-item {{$key==0 ? 'active' : ''}}"> 
                   <img class="d-block w-100" src="{{asset('/uploads/product/'.$images->image)}}">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
		<i class="fa fa-angle-left" aria-hidden="true"></i>
		<span class="sr-only">Əvvəlki</span> 
	</a>
        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
		<i class="fa fa-angle-right" aria-hidden="true"></i> 
		<span class="sr-only">Sonrakı</span> 
	</a>
        <ol class="carousel-indicators">
            @foreach($productAltImages as $key=>$images)
                <li data-target="#carousel-example-1" data-slide-to="{{$key}}" class="{{$key==0 ? 'active' : ''}}">
                    <img class="d-block w-100 img-fluid" src="{{asset('/uploads/product/'.$images->image)}}"/>
                </li>
            @endforeach
        </ol>
    </div>
</div>
<div class="col-xl-7 col-lg-7 col-md-6">
<form name="addToCart" action="{{url('/add-cart')}}" method="post">
@csrf
<div class="single-product-details">
<input type="hidden" name="product_id" value="{{$productDetails->id}}">
<input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
<input type="hidden" name="product_color" value="{{$productDetails->product_color}}">
<input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
<input type="hidden" name="product_price" id="product_price" value="{{$productDetails->product_price}}">
<h2>Məhsul adı : {{$productDetails->product_name}}</h2>
<h5>Məhsulun qiyməti : <span id="getPrice">{{number_format($productDetails->product_price,2)}}</span> AZN</h5>
<p>
<h4>Məhsul haqqında məlumat : </h4>
<p>{{$productDetails->product_description}}</p>
<ul>
    <li>
        <div class="form-group size-st">
            <label class="size-label">Ölçü</label>
            <select id="selSize" name="size" class="selectpicker show-tick form-control">
                <option value>Ölçü seçin</option>
                @foreach($productDetails->attributes as $sizes)
                  <option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
                @endforeach
            </select>
        </div>
    </li>
    <li>
        <div class="form-group quantity-box">
            <label class="control-label">Ədəd</label>
            <input class="form-control" name="quantity" value="1" min="1" max="20" type="number">
        </div>
    </li>
</ul>
<div class="price-box-bar">
    <div class="cart-and-bay-btn">
        <button class="btn hvr-hover" type="submit" style="color:white;" data-fancybox-close="" href="#">Səbətə əlavə et</button>
    </div>
</div>

<div class="add-to-btn">
    <div class="add-comp">
        <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Siyahıya əlavə et</a>
        <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Qarşılaşdır</a>
    </div>
    <div class="share-bar">
        <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
        <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
        <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
        <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
        <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
    </div>
</div>
</div>
</form>
</div>
</div>

<div class="row my-5">
    <div class="col-lg-12">
        <div class="title-all text-center">
            <h1>Xüsusi Məhsullar</h1>
        </div>
        <div class="featured-products-box owl-carousel owl-theme">
            @foreach($featuredProducts as $featured)
            <div class="item">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <img src="{{asset('/uploads/product/'.$featured->image)}}" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="Görüntülə">
                                        <i class="fas fa-eye"></i></a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="Qarşılaşdır"><i class="fas fa-sync-alt"></i></a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="Siyahıya əlavə et"><i class="far fa-heart"></i></a>
                                </li>
                            </ul>
                            <a class="cart" href="{{url('/products/'.$featured->id)}}">Ətraflı oxu</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>{{$featured->product_name}}</h4>
                        <h5>{{number_format($featured->product_price,2)}} AZN</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

</div>
</div>
<!-- End Cart -->

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