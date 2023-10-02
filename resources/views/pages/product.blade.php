@extends('welcome')
@section('products')
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New product</h4>
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
        @foreach($all_product as $key => $product)

        <div class="row property__gallery">
            <div class="col-lg-3 col-md-4  ">
                <div class="product__item">
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ URL::to('public/upload/product/'.$product->product_image)}}">
                        <ul class="product__hover">
                            <li><a href="{{ asset('public/FE/img/product/product-7.jpg')}}" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">{{ $product->product_name}}</a></h6>
                        <div class="product__price">{{ number_format($product->product_price).' '.'VNĐ'}}</div>
                    </div>
                </div>
            </div>

        </div>
        @endforeach

    </div>
</section>
<!-- Product Section End -->
@endsection