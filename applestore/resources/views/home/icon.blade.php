<div class="icon_boxes">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="products_title">Наші найращі якості</div>
            </div>
        </div>
        <div class="row icon_box_row">

            @foreach($icons as $icon)
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="images/forIcons/{{$icon->icon}}" alt=""></div>
                        <div class="icon_box_title">{{$icon->title}}</div>
                        <div class="icon_box_text">
                            <p>{{$icon->desc}}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
