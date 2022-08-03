@extends('layouts.main')

@section('title', 'Оформлення')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/checkout.css">
    <link rel="stylesheet" type="text/css" href="/styles/checkout_responsive.css">
@endsection


@section('content')


        <div class="home">
            <div class="home_container">
                <div class="home_background" style="background-image:url(/images/forCart/cart_1.jpg)"></div>
            </div>
        </div>

        <!-- Checkout -->

        <div class="checkout">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <form action="{{url('place-order')}}" method="POST">
                    {{@csrf_field()}}
                    <div class="row">

                        <!-- Billing Info -->
                        <div class="col-lg-6">
                            <div class="billing checkout_section">
                                <div class="section_title">Платіжна адреса</div>
                                <div class="section_subtitle">Введіть інформацію для доставки</div>
                                <div class="checkout_form_container">
                                    <form action="#" id="checkout_form" class="checkout_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!-- Name -->
                                                <label for="checkout_name">Ім'я<span style="color:red;">*</span></label>
                                                <input type="text" id="checkout_name" name='fname' class="checkout_input" required="required">
                                            </div>
                                            <div class="col-xl-6 last_name_col">
                                                <!-- Last Name -->
                                                <label for="checkout_last_name">Прізвище<span style="color:red;">*</span></label>
                                                <input type="text" id="checkout_last_name" name='lname'class="checkout_input" required="required">
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Phone no -->
                                            <label for="checkout_phone">Номер телефону<span style="color:red;">*</span></label>
                                            <input type="phone" id="checkout_phone" name='phone' class="checkout_input" required="required">
                                        </div>
                                        <div>
                                            <!-- Email -->
                                            <label for="checkout_email">Електронна пошта<span style="color:red;">*</span></label>
                                            <input type="email" id="checkout_email" name='email' class="checkout_input" required="required">
                                        </div>
                                        <div>
                                            <!-- Country -->
                                            <label for="checkout_country">Країна<span style="color:red;">*</span></label>
                                            <input type="text" id="checkout_country" name='country' class="checkout_input" required="required">
                                        </div>
                                        <div>
                                            <!-- City / Town -->
                                            <label for="checkout_city">Місто<span style="color:red;">*</span></label>
                                            <input type="text" id="checkout_city" name='city' class="checkout_input" required="required">
                                        </div>
                                        <div>
                                            <!-- Address -->
                                            <label for="checkout_address">Адреса<span style="color:red;">*</span></label>
                                            <input type="text" id="checkout_address" name='address' class="checkout_input" required="required">
                                        </div>
                                        <div>
                                            <!-- Zipcode -->
                                            <label for="checkout_zipcode">Поштовий індекс<span style="color:red;">*</span></label>
                                            <input type="text" id="checkout_zipcode" name='pincode' class="checkout_input" required="required">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Order Info -->

                        <div class="col-lg-6">
                            <div class="order checkout_section">
                                <div class="section_title">Ваше замовлення</div>
                                <div class="section_subtitle">Деталі замовлення</div>

                                <!-- Order details -->
                                <div class="order_list_container">
                                    <div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
                                        <div class="order_list_title"><strong>Техніка</strong></div>
                                        <div class="order_list_value ml-auto"><strong>Кількість</strong></div>
                                        <div class="order_list_value ml-auto"><strong>Всього</strong></div>
                                    </div>
                                    <ul class="order_list">
                                        @foreach(Cart::session($_COOKIE['cart_id'])->getContent() as $item)
                                            <li class="d-flex flex-row align-items-center justify-content-start">
                                                <div class="order_list_title">{{$item->name}}</div>
                                                <div class="order_list_title ml-auto">{{$item->quantity}}</div>
                                                <div class="order_list_value ml-auto">{{$item->price * $item->quantity}} ₴</div>
                                            </li>
                                        @endforeach
                                            <li class="d-flex flex-row align-items-center justify-content-start">
                                                <div>
                                                    <div class="order_list_title"><strong>Всього до сплати</strong></div>
                                                    <div class="order_list_value ml-auto">{{ Cart::getTotal()}} ₴</div>
                                                </div>

                                            </li>
                                    </ul>
                                </div>

                                <!-- Payment Options -->
                                <!--<div class="payment">
                                    <div class="payment_options">
                                        <label class="payment_option clearfix">Кредитна карта
                                            <input type="radio" name="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>-->

                                <!-- Order Text -->
                                @if(Cart::session($_COOKIE['cart_id'])->getTotalQuantity() == 0)
                                @else
                                    <button type='submit' class=" order_button btn-dark h-500">Оформити</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>




@endsection

@section('custom_js')
    <script src="js/checkout.js"></script>
@endsection
