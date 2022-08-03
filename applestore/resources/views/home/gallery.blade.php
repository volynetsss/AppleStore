<div class="home">
    <div class="home_slider_container">

        <!-- Home Slider -->
        <div class="owl-carousel owl-theme home_slider">

            <!-- Slider Item -->
            @foreach($galleries as $gallery)
                <div class="owl-carousel owl-theme home_slider">

                    <!-- Slider Item -->
                    <div class="owl-item home_slider_item">
                        <div class="home_slider_background" style="background-image:url('/images/forGallery/{{$gallery->img}}')"></div>
                        <div class="home_slider_content_container">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
                                            <div class="home_slider_title">{{$gallery->title}}</div>
                                            <div class="home_slider_subtitle">{{$gallery->desc}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Slider Item -->


        </div>

        <!-- Home Slider Dots -->
        @php
            $i = 0;
        @endphp
        <div class="home_slider_dots_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_slider_dots">
                            <ul id="home_slider_custom_dots" class="home_slider_custom_dots">
                                @foreach($galleries as $gallery)
                                    @if(($loop->first))
                                        @php
                                            $i++;
                                        @endphp
                                        <li class="home_slider_custom_dot active">0{{$i}}.</li>
                                    @elseif(isset($gallery))
                                        @php
                                            $i++;
                                        @endphp
                                        <li class="home_slider_custom_dot ">0{{$i}}.</li>
                                    @else
                                        @break
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
