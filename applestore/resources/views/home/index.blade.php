@extends('layouts.main')

@section('title', 'Головна')

@section('content')
    <!-- Home -->

    @include('home/gallery')


    <!-- Products -->

    <div class="products">
        <div class="container">
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
                                <div class="product_image"><img src="images/forProducts/{{$image}}" alt="{{$product->title}}"></div>
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


    @include('home/icon')
    <!-- Icon Boxes -->



    <!-- Newsletter -->
@endsection
