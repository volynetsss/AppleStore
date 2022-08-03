@extends('layouts.main')

@section('title', $cat->title)

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="styles/categories.css">
    <link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
@endsection


@section('content')

    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url('/images/forCategories/{{$cat->img}}')"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">{{$cat->title}}<span>.</span></div>
                                <div class="home_text"><p>{{$cat->description}}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Product Sorting -->
                    <div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                        <div class="results">В цій категорії <span>{{$cat->products->count()}}</span>
                            @if($cat->products->count() == 1)
                                запис
                            @elseif($cat->products->count() > 4)
                                записів
                            @else записи
                            @endif

                        </div>

                        <div class="sorting_container ml-md-auto">
                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Сортувати</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="product_sorting_btn" data-order="default"><span>Звичайно</span></li>
                                            <li class="product_sorting_btn" data-order="price-low-high"><span>Ціна: Низ-Верх</span></li>
                                            <li class="product_sorting_btn" data-order="price-high-low"><span>Ціна: Верх-Низ</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
                    {{$products->appends(request()->query())->links('pagination.index')}}
                </div>
            </div>
        </div>
    </div>

    <!-- Icon Boxes -->




@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            $('.product_sorting_btn').click(function (e) {
                $('.sorting_text').text($(this).find('span').text())
                let orderBy = $(this).data('order')

                $.ajax({
                    url: "{{route('showCategory',$cat->alias)}}",
                    type: "GET",
                    data: {
                        orderBy: orderBy,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        let positionParameters = location.pathname.indexOf('?');
                        let url = location.pathname.substring(positionParameters,location.pathname.length);
                        let newURL = url + '?';
                        newURL += "&page={{isset($_GET['page']) ? $_GET['page'] : 1}}"+'orderBy=' + orderBy; // http://127.0.0.1:8001/phones?orderBy=name-z-a
                        history.pushState({}, '', newURL);

                        $('.product_pagination a').each(function(index, value){
                            let link= $(this).attr('href')
                            $(this).attr('href',link+'&orderBy='+orderBy)
                        })

                        $('.product_grid').html(data)

                        $('.product_grid').isotope('destroy')
                        $('.product_grid').imagesLoaded( function() {
                            let grid = $('.product_grid').isotope({
                                itemSelector: '.product',
                                layoutMode: 'fitRows',
                                fitRows:
                                    {
                                        gutter: 30
                                    }
                            });
                        });

                    }
                });
            })
        })
    </script>
@endsection
