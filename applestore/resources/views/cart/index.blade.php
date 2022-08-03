@extends('layouts.main')

@section('title', 'Корзина')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/cart.css">
    <link rel="stylesheet" type="text/css" href="/styles/cart_responsive.css">
@endsection


@section('content')

    <!-- Home -->


    <--Cart::session($_COOKIE['cart_id'])->getContent()
    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(images/forCart/cart_1.jpg)"></div>
        </div>
    </div>

    <!-- Cart Info -->

    <div class="cart_info">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Column Titles -->
                    <div class="cart_info_columns clearfix">
                        <div class="cart_info_col cart_info_col_product">Продукт</div>
                        <div class="cart_info_col cart_info_col_price">Ціна</div>
                        <div class="cart_info_col cart_info_col_quantity">Кільксіть</div>
                        <div class="cart_info_col cart_info_col_total">Всього</div>
                    </div>
                </div>
            </div>
            <div class="row cart_items_row">
                <div class="col">

                    @foreach(Cart::session($_COOKIE['cart_id'])->getContent() as $item)
                    <!-- Cart Item -->
                        <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                            <!-- Name -->
                            <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_item_image">
                                    <div><img src="/images/forProducts/{{$item->attributes->img}}" alt=""></div>
                                </div>
                                <div class="cart_item_name_container">
                                    <div class="cart_item_name"><a href="{{route('showProduct', ['category', $item->alias])}}">{{$item->name}}</a></div>
                                    <form action="{{ route('cartDestroy') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <button class="btn-dark cart_item_edit">Видалити продукт</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Price -->
                            <div class="cart_item_price">{{$item->price}} ₴</div>
                            <!-- Quantity -->
                            <form action="{{ route('cartUpdate') }}" method="POST">


                                <div class="cart_item_quantity">
                                    <div class="product_quantity_container">
                                        <div class="product_quantity clearfix">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id}}" >
                                            <span>Кільк.</span>
                                            <input type='text' name='quantity' id="quantity_input" type="text" pattern="[0-9]*" value="{{$item->quantity}}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" style='width:100%;'class="btn-dark">Оновити</button>
                            </form>
                            <!-- Total -->
                            <div class="cart_item_total">{{$item->price * $item->quantity}} ₴</div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="row row_extra">
                <div class="col-lg-6 offset-lg-2">
                    <div class="cart_total">
                        <div class="section_title">Кінцевий результат</div>
                        <div class="section_subtitle">Ваш рахунок </div>
                        <div class="cart_total_container">
                            <ul>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Повна вартість</div>
                                    <div class="cart_total_value ml-auto">{{ Cart::getTotal()}} ₴</div>
                                </li>
                            </ul>
                        </div>
                        @if(Cart::session($_COOKIE['cart_id'])->getTotalQuantity() == 0)

                        @else
                            <div class="button checkout_button"><a href="{{route('productCheckout')}}">Оформити замовлення</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Icon Boxes -->




@endsection

@section('custom_js')
    <script src="/js/cart.js"></script>

@endsection
