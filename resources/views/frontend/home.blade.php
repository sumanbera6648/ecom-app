@extends('frontend.layouts.master')
@section('mainContent')
    <!-- Slider Area -->
    <section class="hero-slider">
        <!-- Single Slider -->
        {{-- <div class="col-lg-7 col-12">

        </div> --}}
        <!--/ End Single Slider -->
    </section>
    <!--/ End Slider Area -->
    @if (count($banners) > 0)
        <section id="Gslider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($banners as $key => $banner)
                    <li data-target="#Gslider" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
                    </li>
                @endforeach

            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach ($banners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img class="first-slide" src="{{ asset('banner_photo/' . $banner->photo) }}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block text-right">
                            {{-- <h1 class="wow fadeInDown">{{ $banner->title }}</h1> --}}

                                <div class="text-dark">
                                    <h1>{{ $banner->title }}</h1>
                                    <p>{{ $banner->description }}</p>
                                    <div class="button">
                                        <a href="#" class="btn bg-primary">Shop Now!</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </section>
    @endif
    <!-- Start Small Banner  -->
    <section class="small-banner ">
        <div class="container-fluid">
            <h3>CATEGORY</h3>
            <div class="row pt-2">
                @php
                    $category_lists = DB::table('categories')
                        ->where('status', 'active')
                        ->limit(3)
                        ->get();
                @endphp
                @if (count($category_lists) > 0)
                    @foreach ($category_lists as $cat)
                        @if ($cat->is_parent == 1)
                            <!-- Single Banner  -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-banner" style="height:300px;width:450px;">
                                    @if ($cat->photo)
                                        <img src="{{ asset('category_photo/' . $cat->photo) }}" alt="{{ $cat->photo }}">
                                    @else
                                        <img src="https://via.placeholder.com/600x370" alt="#">
                                    @endif
                                    <div class="content">
                                        <p>{{ $cat->title }}</p>
                                        <p style="color:black;font-size:12px;">{{ $cat->summary }}</p>
                                        <a href="#">Discover Now</a>
                                    </div>

                                </div>


                                {{-- <a href="{{route('product-cat',$cat->slug)}}">Discover Now</a> --}}

                            </div>
                        @endif
                    @endforeach
                    <!-- /End Single Banner  -->
                @else
                    <h3 class="m-auto">No data founded yet</h3>
                @endif
            </div>
        </div>
    </section>
    <!-- End Small Banner -->

    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @php
                                    $categories = DB::table('categories')
                                        ->where('status', 'active')
                                        ->where('is_parent',1)
                                        ->get();
                                        // $sub_cat = DB::table('categories')->where('status','active')->where('title','Man Collectons')->get();;
                                    // dd($categories);
                                @endphp
                                @if (count($categories) > 0)
                                    <button class="btn" style="background:black" data-filter="*">
                                        All Products
                                    </button>
                                    @foreach ($categories as $key => $cat)
                                        <button class="btn" style="background:none;color:black;"
                                            data-filter=".{{ $cat->id }}">
                                            {{ $cat->title }}
                                        </button>
                                    @endforeach
                                @else
                                    <h3>DATA NOT FOUND</h3>
                                @endif
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <!-- Start Single Tab -->

                            <div class="tab-pane fade show active" id="man" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        @foreach ($product_lists as $key => $product)
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        @if (session('messages'))
                                                        <div>{{ session('messages') }}</div>
                                                        @endif
                                                        <a href="#">
                                                            <img class="default-img"
                                                                src="{{ asset('product_photo/' . $product->photo) }}"
                                                                alt="">
                                                            @if ($product->stock <= 0)
                                                                <span class="out-of-stock">Sale out</span>
                                                            @elseif($product->condition ==='new')
                                                                <span class="new">New</span>
                                                                @elseif($product->condition ==='hot')
                                                                <span class="new">Hot</span>
                                                            @else
                                                                <span class="price-dec">{{ $product->discount }}%
                                                                    Off</span>
                                                            @endif
                                                        </a>
                                                        <div class="button-head">
                                                            <div class="product-action">
                                                                <a data-toggle="modal" data-target="#exampleModal"
                                                                    title="Quick View" href="#"><i
                                                                        class=" ti-eye"></i><span>Quick
                                                                        Shop</span></a>
                                                                <a title="Wishlist" href="#"><i
                                                                        class=" ti-heart "></i><span>Add to
                                                                        Wishlist</span></a>
                                                                <a title="Compare" href="#"><i
                                                                        class="ti-bar-chart-alt"></i><span>Add to
                                                                        Compare</span></a>
                                                            </div>
                                                            <div class="product-action-2">
                                                                <a
                                                                    href="{{route('add-cart', [$product->id])}}"
                                                                    class="btn btn-success btn-block"
                                                                >Add To Cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="product-details.html">{{ $product->title }}</a></h3>
                                                        <h3><a href="product-details.html">{{ $product->size }}</a></h3>
                                                        <h3><a href="product-details.html">{{ $product->brand->title }}</a></h3>
                                                        <div class="product-price">
                                                            @php
                                                                $after_discount = $product->price - ($product->price * $product->discount) / 100;
                                                            @endphp
                                                            <span>₹{{ number_format($after_discount, 2) }}</span>
                                                            <del
                                                                style="padding-left:4%;">${{ number_format($product->price, 2) }}</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--/ End Single Tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->

    <!-- Start Midium Banner  -->
    {{-- <section class="midium-banner">
        <div class="container">
            <div class="row">

                <!-- Single Banner  -->
                @foreach ($brands as $product)
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner">
                        <a href="#">
                            <img class="default-img"
                                src="{{ asset('brand_photo/' . $product->photo) }}"
                                alt="">
                            @if ($product->stock <= 0)
                                <span class="out-of-stock">Sale out</span>
                            @elseif($product->condition ==='new')
                                <span class="new">New</span>
                                @elseif($product->condition ==='hot')
                                <span class="new">Hot</span>
                            @else
                                <span class="price-dec">{{ $product->discount }}%
                                    Off</span>
                            @endif
                        </a>
                        <div class="content">
                            <p>Man's Collectons</p>
                            <h3>Man's items <br>Up to<span> 50%</span></h3>
                            <a href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- /End Single Banner  -->
                <!-- Single Banner  -->

                <!-- /End Single Banner  -->

            </div>
        </div>
    </section> --}}
    <!-- End Midium Banner -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Hot Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-12">

                    <div class="owl-carousel popular-slider">
                        @foreach ($product_lists as $product)
                        @if($product->condition=='hot')
                        <!-- Start Single Product -->
                        <div class="single-product">
                            <div class="product-img">
                                <a href="#">
                                    <img class="default-img"
                                        src="{{ asset('product_photo/'. $product->photo) }}"
                                        alt="">

                                    @if ($product->stock <= 0)
                                        <span class="out-of-stock">Sale out</span>
                                        @elseif($product->condition ==='hot')
                                        <span class="new">Hot</span>
                                    @else
                                        {{-- <span class="price-dec">{{ $product->discount}}%
                                            Off</span> --}}
                                    @endif
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i
                                                class=" ti-eye"></i><span>Quick Shop</span></a>
                                        <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to
                                                Wishlist</span></a>
                                        <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to
                                                Compare</span></a>
                                    </div>
                                    <div class="product-action-2">
                                        <a title="Add to cart" href="#">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">{{($product->title)}}</a></h3>
                                <div class="product-price">
                                    @php
                                        $after_discount = $product->price - ($product->price * $product->discount) / 100;
                                    @endphp
                                    <span>₹{{ number_format($after_discount, 2) }}</span>
                                    <del
                                        style="padding-left:4%;">${{ number_format($product->price, 2) }}</del>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->
                        @endif
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->

    <section class="section free-version-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 offset-md-2 col-xs-12">
                    <div class="section-title mb-60">
                        <span class="text-white wow fadeInDown" data-wow-delay=".2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">Eshop Free Lite
                            version</span>
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Currently You are
                            using free<br> lite Version of Eshop.</h2>
                        <p class="text-white wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">Please, purchase
                            full version of the template to get all pages,<br> features and commercial license.</p>

                        <div class="button">
                            <a href="https://wpthemesgrid.com/downloads/eshop-ecommerce-html5-template/" target="_blank"
                                rel="nofollow" class="btn wow fadeInUp" data-wow-delay=".8s">Purchase Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Shop Home List  -->
    <section class="shop-home-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>On sale</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="https://via.placeholder.com/115x140" alt="#">
                                    <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h4 class="title"><a href="#">Licity jelly leg flat Sandals</a></h4>
                                    <p class="price with-discount">$59</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="https://via.placeholder.com/115x140" alt="#">
                                    <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                    <p class="price with-discount">$44</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="https://via.placeholder.com/115x140" alt="#">
                                    <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                    <p class="price with-discount">$89</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List  -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>Best Seller</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="https://via.placeholder.com/115x140" alt="#">
                                    <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                    <p class="price with-discount">$65</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="https://via.placeholder.com/115x140" alt="#">
                                    <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                    <p class="price with-discount">$33</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="https://via.placeholder.com/115x140" alt="#">
                                    <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                    <p class="price with-discount">$77</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List  -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>Top viewed</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="https://via.placeholder.com/115x140" alt="#">
                                    <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                    <p class="price with-discount">$22</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="https://via.placeholder.com/115x140" alt="#">
                                    <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                    <p class="price with-discount">$35</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List  -->
                    <!-- Start Single List  -->
                    <div class="single-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="list-image overlay">
                                    <img src="https://via.placeholder.com/115x140" alt="#">
                                    <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                <div class="content">
                                    <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                    <p class="price with-discount">$99</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List  -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Home List  -->

    <!-- Start Shop Blog  -->
    <section class="shop-blog section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>From Our Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog  -->
                    <div class="shop-single-blog">
                        <img src="https://via.placeholder.com/370x300" alt="#">
                        <div class="content">
                            <p class="date">22 July , 2020. Monday</p>
                            <a href="#" class="title">Sed adipiscing ornare.</a>
                            <a href="#" class="more-btn">Continue Reading</a>
                        </div>
                    </div>
                    <!-- End Single Blog  -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog  -->
                    <div class="shop-single-blog">
                        <img src="https://via.placeholder.com/370x300" alt="#">
                        <div class="content">
                            <p class="date">22 July, 2020. Monday</p>
                            <a href="#" class="title">Man’s Fashion Winter Sale</a>
                            <a href="#" class="more-btn">Continue Reading</a>
                        </div>
                    </div>
                    <!-- End Single Blog  -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Blog  -->
                    <div class="shop-single-blog">
                        <img src="https://via.placeholder.com/370x300" alt="#">
                        <div class="content">
                            <p class="date">22 July, 2020. Monday</p>
                            <a href="#" class="title">Women Fashion Festive</a>
                            <a href="#" class="more-btn">Continue Reading</a>
                        </div>
                    </div>
                    <!-- End Single Blog  -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Blog  -->

    <!-- Start Shop Services Area -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over $100</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services Area -->

    <!-- Start Shop Newsletter  -->
    <section class="shop-newsletter section">
        <div class="container">
            <div class="inner-top">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-12">
                        <!-- Start Newsletter Inner -->
                        <div class="inner">
                            <h4>Newsletter</h4>
                            <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                            <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                                <input name="EMAIL" placeholder="Your email address" required="" type="email">
                                <button class="btn">Subscribe</button>
                            </form>
                        </div>
                        <!-- End Newsletter Inner -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Newsletter -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            class="ti-close" aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-lg-6 offset-lg-3 col-12">
                            <h4
                                style="margin-top:100px;font-size:14px; font-weight:500; color:#F7941D; display:block; margin-bottom:5px;">
                                Eshop Free Lite</h4>
                            <h3 style="font-size:30px;color:#333;">Currently You are using free lite Version of Eshop.<h3>
                                    <p style="display:block; margin-top:20px; color:#888; font-size:14px; font-weight:400;">
                                        Please, purchase full version of the template to get all pages, features and
                                        commercial license</p>
                                    <div class="button" style="margin-top:30px;">
                                        <a href="https://wpthemesgrid.com/downloads/eshop-ecommerce-html5-template/"
                                            target="_blank" class="btn" style="color:#fff;">Buy Now!</a>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
@endsection
@push('styles')
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons'
        async='async'></script>
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons'
        async='async'></script>
    <style>
        /* Banner Sliding */
        #Gslider .carousel-inner {
            background: #000000;
            color: black;
        }

        #Gslider .carousel-inner {
            height: 550px;
        }

        #Gslider .carousel-inner img {
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
            bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 50px;
            font-weight: bold;
            line-height: 100%;
            color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
            font-size: 18px;
            color: black;
            margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
            bottom: 70px;
        }

    </style>
@endpush
