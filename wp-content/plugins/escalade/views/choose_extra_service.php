<?php

$cat = isset($_GET['id_extra_service_category']) ? $_GET['id_extra_service_category'] : 0;
$query_args_meta = array(
    'posts_per_page' => -1,
    'post_type' => 'extra_service',
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'category',
            'value' => $cat,
            'compare' => 'LIKE'
        )
    )
);
$extra_services = get_posts($query_args_meta);
var_dump($extra_services);
?>
<link rel='stylesheet' id='escalade-css'  href='/wp-content/plugins/escalade/assets/css/responsive.css?ver=4.9.8' type='text/css' media='all' />
<script type="text/javascript">
 $(function () {
   $('html, body').animate({scrollTop: $("#choose_services").offset().top }, 2000, 'linear');
     $(".add_service").click(function(){
        var _this = $(this); var id = _this.attr("name");
        var quantity = $('.quality_'+id).val();
        $.get(_this.attr("href")+'/'+quantity, function(data){
            $("#service_added").append(data);
        });
     });
});
</script>
<section class="choose-services" id="choose_services">
    <div class="container">
        <div class="contact">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-md-xs-12">
                    <div class="title-1">EXPERIENCES</div>
                    <div class="title-2">& MORE</div>
                    <div class="box_active">
                        <span class="info">CHOOSE YOUR LOCAL EXPERIENCES</span>
                        <span class="modify"><i class="fa fa-angle-right"></i></span>
                    </div>
                    <div id="service_added">
                        @if(Session::get('cart.extra_services'))
                            @foreach(Session::get('cart.extra_services') as $ex)
                            <div class="box item">
                                <span class="info">{{ $ex['title'] }} x{{ $ex['quantity'] }}</span>
                                <span class="modify"><a href="/extra-service/{{ Session::get('cart.accommodation.id_accommodation') }}">MODIFY</a></span>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="box_checkout">
                        <a href="/checkout">PROCESS CHECK OUT</a>
                    </div>
                </div>
                <?php if($extra_services): ?>
                <div class="col-md-7 col-lg-7 col-md-xs-12 slide_services">
                    <div class="owl-carousel accomd-modations-slide_room owl-carousel owl-theme owl-loaded">
                        @foreach($extra_services as $service)
                        <div class="items item-1">
                            <div class="img-thumb">
                                @if(isset($service['photos'][0]['aliasname']) && $service['photos'][0]['aliasname'])
                                    <img src="/storage/images/origin/{{ $service['photos'][0]['aliasname'] }}" alt="">
                                @else
                                    <img src="/assets/home/images/book/b1.png" alt="">
                                @endif
                            </div>
                            <div class="content">
                                <div class="c-left">
                                    <h2 class="title">{{ $service['title'] }}</h2>
                                    <p>
                                        {!! $service['description'] !!}
                                    </p>
                                    <!--<input type="text" required name="date_from" class="awe-calendar select_date" placeholder="SELECT DATE" style="color:#fff;">-->
                                    <input type="number" required name="quality" class="quality_{{ $service['_id'] }}" value="1" placeholder="QUALITY">
                                </div>
                                <div class="c-right">
                                    <div class="t1">{{ $service['price'] }}</div>
                                    <div class="t2">Excluding Taxs & Fees</div>
                                    <hr />
                                    <!--<div class="t2">Room Changes: <b>01 USD</b></div>-->
                                    <div class="t2">Tax: <b>{{ $service['tax'] }} USD</b></div>
                                    <!--<div class="t2">Quality: <b>01</b></div>-->
                                    <hr />
                                    <div class="t3">Total Rates: <b>{{ $service['price'] + $service['tax'] }} USD</b></div>
                                </div>
                                <div class="add-button">
                                    <a href="/choose-service/add/{{ $service['_id'] }}" onclick="return false;" name="{{ $service['_id'] }}" class="btn add_service">ADDED</a>
                                    <!--<button type="button" class="btn add_service">ADDED</button>-->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <?php endif: ?>
            </div>
        </div>
    </div>
</section>
