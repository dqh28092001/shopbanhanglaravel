@extends('welcome')
@section('products')
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    @foreach($brand_name as $key => $name_brand)
                    <h4>Brand - {{ ($name_brand->brand_name) }}</h4>
                        
                    @endforeach
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li class="" ><a href="{{ URL::to('/home') }}"  style="color: black">ALL</a></li>
                    @foreach($brand as $key => $brand)
                    <li>
                        <a  href="{{ URL::to('/thuong_hieu_san_pham/'.$brand->brand_id) }}" style="color: black">
                            {{ $brand->brand_name }}
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>

        <div class="row property__gallery">
            @foreach($brand_by_id as $key => $product)

            <div class="col-lg-3 col-md-4 col-sm-6 mix women">
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
            <!-- Thêm các sản phẩm khác tại đây -->
            @endforeach
        </div>
        
      
</section>
<!-- Product Section End -->
@endsection
