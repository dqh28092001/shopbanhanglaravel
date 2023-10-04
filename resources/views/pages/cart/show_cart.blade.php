@extends('welcome')
@section('products')
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                // Cart::content() hiển thị nội dung 
                    $content = Cart::content();
                    ?>
                <div class="shop__cart__table">
                    <table>
                        <thead>

                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($content as $key => $value_content)
                            <tr>
                                <td class="cart__product__item">
                                    <img src="{{ URL::to('public/upload/product/'.$value_content->options->image)}}" width="100" height="100" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>{{$value_content->name  }}</h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">{{ number_format($value_content->price).' '.'VNĐ'}}</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="{{ $value_content->qty }}">
                                    </div>
                                </td>
                                <td class="cart__total">
                                    <?php
                                    $subtotal = $value_content->price * $value_content->qty;
                                    echo number_format($subtotal).' '.'VNĐ';   
                                    ?>

                                </td>
                                <td class="cart__close"><span class="icon_close"></span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="{{ URL::to('/home') }}">Continue Shopping</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                    <a href="#"><span class="icon_loading"></span> Update cart</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Tax <span>{{ number_format(Cart::tax(), 0, ',', ',') }}</span></li>
                        <li>Total <span>{{ number_format(Cart::total(), 0, ',', ',') }}</span></li>
                    </ul>
                    <a href="#" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection