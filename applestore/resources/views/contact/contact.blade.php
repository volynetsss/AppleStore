@extends('layouts.main')

@section('title', 'Наші конатки')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/contact.css">
    <link rel="stylesheet" type="text/css" href="/styles/contact_responsive.css">
@endsection

@section('custom_js')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
    <script src="/js/contact.js"></script>
@endsection

@section('content')

    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(/images/forContact/contact_1.jpg)"></div>

        </div>
    </div>

    <!-- Contact -->

    <div class="contact">
        <div class="container">
            <div class="row">

                <!-- Get in touch -->
                <div class="col-lg-8 contact_col">
                    <div class="get_in_touch">
                        <div class="section_title">Звернутися до служби підтримки</div>
                        <div class="section_subtitle">Вкажіть ваші дані</div>
                        <div class="contact_form_container">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                            <form id="contact_form" class="contact_form" action="/contact" method="POST">

                                <div class="row">
                                    <div class="col-xl-6">
                                        <!-- Name -->
                                        <label for="contact_name">Ім'я<span style="color:red;">*</span></label>
                                        <input name='name' type="text" id="contact_name" class="contact_input" required="required">
                                    </div>
                                    <div class="col-xl-6 last_name_col">
                                        <!-- Last Name -->
                                        <label for="contact_last_name">Прізвище<span style="color:red;">*</span></label>
                                        <input name='last_name' type="text" id="contact_last_name" class="contact_input" required="required">
                                    </div>
                                </div>
                                <div>
                                    <label for="contact_company">Електронна пошта<span style="color:red;">*</span></label>
                                    <input name='email' type="email" id="contact_company" class="contact_input" required="required">
                                </div>
                                <div>
                                    <label for="contact_textarea">Ваше запитання, чи порада<span style="color:red;">*</span></label>
                                    <textarea name='message' id="contact_textarea" class="contact_input contact_textarea" required="required"></textarea>
                                </div>
                                @csrf
                                <button type='submit' class="button contact_button"><span>Відправити</span></button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 offset-xl-1 contact_col">
                    <div class="contact_info">
                        @foreach($infos as $info)
                            <div class="contact_info_section">
                                <div class="contact_info_title">{{$info->title}}</div>
                                <ul>
                                    <li>Phone: <span>{{$info->phone}}</span></li>
                                    <li>Email: <span>{{$info->email}}</span></li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Newsletter -->
@endsection
