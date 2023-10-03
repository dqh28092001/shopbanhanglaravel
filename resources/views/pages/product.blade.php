@extends('welcome')
@section('products')
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg"
                    data-setbg="{{ asset('public/FE/img/categories/category-1.jpg')}}">
                    <div class="categories__text">
                        <h1>Women’s fashion</h1>
                        <p>Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                            edolore magna aliquapendisse ultrices gravida.</p>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg"
                            data-setbg="{{ asset('public/FE/img/categories/category-2.jpg')}}">
                            <div class="categories__text">
                                <h4>Men’s fashion</h4>
                                <p>358 items</p>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg"
                            data-setbg="{{ asset('public/FE/img/categories/category-3.jpg')}}">
                            <div class="categories__text">
                                <h4>Kid’s fashion</h4>
                                <p>273 items</p>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg"
                            data-setbg="{{ asset('public/FE/img/categories/category-4.jpg')}}">
                            <div class="categories__text">
                                <h4>Cosmetics</h4>
                                <p>159 items</p>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg"
                            data-setbg="{{ asset('public/FE/img/categories/category-5.jpg')}}">
                            <div class="categories__text">
                                <h4>Accessories</h4>
                                <p>792 items</p>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>Product Brands</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">All</li>
                    @foreach($brand as $key => $brand)
                    <li>
                        <a href="{{ URL::to('/thuong_hieu_san_pham/'.$brand->brand_id) }}" style="color: black">
                            {{ $brand->brand_name }}
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <div class="row property__gallery">
            @foreach($all_product as $key => $product)
            <div class="col-lg-3 col-md-4">
                <div class="product__item">
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ URL::to('public/upload/product/'.$product->product_image)}}">
                        <ul class="product__hover">
                            <li><a href="{{ URL::to('public/upload/product/'.$product->product_image)}}" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="{{ URL::to('/detail_product/'.$product->product_id) }}"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">{{ $product->product_name}}</a></h6>
                        <div class="product__price">{{ number_format($product->product_price).' '.'VNĐ'}}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
       

</section>
<!-- Product Section End -->
@endsection