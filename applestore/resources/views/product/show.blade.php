@extends('layouts.main')

@section('title', $item->title)

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/product.css">
    <link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
@endsection

@section('custom_js')
    <script src="/js/product.js"></script>
    <script>
        $(document).ready(function () {
            $('.cart_button').click(function (event) {
                event.preventDefault()
                store()
            })
        })

        function store() {
            let id = $('.details_name').data('id')
            let qty = parseInt($('#quantity_input').val())

            let total_qty = parseInt($('.cart-qty').text())
            total_qty += qty
            $('.cart-qty').text(total_qty)

            $.ajax({
                url: "{{route('cartStore')}}",
                type: "POST",
                data: {
                    id: id,
                    qty: qty,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                    console.log(data)
                },
                error: (data) => {
                    console.log(data)
                }
            });
        }
    </script>
@endsection

@section('content')
    <!-- Home -->
    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url('/images/forCategories/{{$category->img}}')"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">{{$category->title}}<span>.</span></div>
                                <div class="home_text"><p>{{$category->description}}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->

    <div class="product_details">
        <div class="container">
            <div class="row details_row">
                @php
                    $image= '';
                    if(count($item->images) > 0) {
                        $image = $item->images[0]['img'];
                    } else {
                        $image = 'no_image.jpeg';
                    }
                @endphp
                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="details_image">
                        <div class="details_image_large"><img src="/images/forProducts/{{$image}}" alt="{{$item->title}}">
                            @if(isset($item->new_price))
                                <div class="product_extra product_sale"><a href="{{route('showProduct', ['category', $item->alias])}}">SALE</a></div>
                            @endif
                        </div>
                        <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                            @if($image == 'no_image.jpeg')
                            @else
                                @foreach($item->images as $img)
                                    @if($loop->first)
                                        <div class="details_image_thumbnail active" data-image="/images/forProducts/{{$img['img']}}"><img src="/images/forProducts/{{$img['img']}}" alt="{{$item->title}}"></div>
                                    @else
                                        <div class="details_image_thumbnail" data-image="/images/forProducts/{{$img['img']}}"><img src="/images/forProducts/{{$img['img']}}" alt="{{$item->title}}"></div>
                                    @endif
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <div class="details_content">
                        <div class="details_name" data-id="{{$item->id}}">{{$item->title}}</div>
                        @if(isset($item->new_price))
                            <div class="details_discount">{{$item->price}} ₴</div>
                            <div class="details_price">{{$item->new_price}} ₴</div>
                        @else
                            <div class="details_price">{{$item->price}} ₴</div>
                        @endif
                        <div class="in_stock_container">
                            <div class="availability">Колір:</div>
                            <input id='color' type="color" disabled value="{{$item->color}}">
                        </div>
                        <!-- In Stock -->
                        <div class="in_stock_container">
                            <div class="availability">Наявність:</div>
                                @if($item->in_stock)
                                <span>В наявності</span>
                            @else
                                <span style="color:red;">Не в наявності</span>
                            @endif

                        </div>
                        <div class="details_text">
                            <p>{{$item->description}}</p>
                        </div>

                        <!-- Product Quantity -->
                        @if($item->in_stock)
                            <div class="product_quantity_container">
                                <div class="product_quantity clearfix">
                                    <span>Кільк.</span>
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                                <div class="button cart_button"><a href="#">В корзину</a></div>
                            </div>
                        @else

                        @endif

                        <!-- Share -->
                        <div class="details_share">
                            <span>Поділитись:</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row description_row">
                <div class="col">
                    <div class="description_title_container">
                        <div class="description_title">Опис</div>
                        <!-- <div class="reviews_title"><a href="#">Reviews <span>(1)</span></a></div> -->
                    </div>
                    <div class="description_text">
                        <p>{{$item->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->
        @if($products && $products->count())
        <div class="products">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="products_title">Товари тієї ж категорії</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                        <div class="product_grid">

                            <!-- Product -->
                            @foreach($products as $product)
                                @php
                                    $image= '';
                                    if(count($product->images) > 0) {
                                        $image = $product->images[0]['img'];
                                    } else {
                                        $image = 'no_image.jpeg';
                                    }
                                @endphp
                                <div class="product">
                                    <div class="product_image"><img src="/images/forProducts/{{$image}}" alt="{{$product->title}}"></div>
                                    @if(isset($product->new_price))
                                        <div class="product_extra product_sale"><a href="{{route('showProduct', ['category', $product->alias])}}">SALE</a></div>
                                    @endif
                                    <div class="product_content">
                                        <div class="product_title"><a href="{{route('showProduct', ['category', $product->alias])}}">{{$product->title}}</a></div>
                                        @if(isset($product->new_price))
                                            <div style="text-decoration:line-through;color:red;">{{$product->price}} ₴</div>
                                            <div class="product_price">{{$product->new_price}} ₴</div>
                                        @else
                                            <div class="product_price">{{$product->price}} ₴</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif


    <!-- Newsletter -->
@endsection
