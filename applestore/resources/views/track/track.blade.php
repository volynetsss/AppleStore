@extends('layouts.main')

@section('title', 'Трекінг')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/contact.css">
    <link rel="stylesheet" type="text/css" href="/styles/contact_responsive.css">
@endsection

@section('custom_js')
    <script src="/js/contact.js"></script>
    <script>



    </script>
@endsection

@section('content')

    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(/images/forTracking/track_1.jpg)"></div>

        </div>
    </div>

    <!-- Contact -->

    <div class="contact">
        <div class="container">
            <div class="row">

                <!-- Get in touch -->
                <div class="col-lg-8 contact_col">
                    <div class="get_in_touch">
                        <div class="section_title">Відслідкування статусу посилки</div>
                        <div class="contact_form_container">

                                <div class="row">
                                    <div class="col-xl-6">
                                        <!-- Name -->

                                        @if(isset($tracking->tracking_no))
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!-- Name -->
                                                    <label for="contact_tracking_no">Код</label>
                                                    <input name='tracking_no' value="{{$tracking->tracking_no}}" disabled type="text" id="contact_tracking_no" class="contact_input" required="required">
                                                </div>
                                                <div class="col-xl-6 last_name_col">
                                                    <!-- Last Name -->
                                                    <label for="contact_tracking_no">Статус</label>
                                                    <input name='tracking_no' value="{{$tracking->status == 0 ? 'очікування...' : 'виконано !'}}" disabled type="text" id="contact_tracking_no" class="contact_input" required="required">
                                                </div>
                                            </div>


                                        @else
                                            <p>Посилки із таким кодом немає</p>
                                        @endif


                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
            </div>

        </div>
    </div>


    <!-- Newsletter -->
@endsection
