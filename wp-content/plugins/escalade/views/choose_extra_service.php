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
//var_dump($extra_services);
?>
<link rel='stylesheet' id='escalade-css'  href='/wp-content/plugins/escalade/assets/css/responsive.css?ver=4.9.8' type='text/css' media='all' />
<link rel='stylesheet' id='escalade-css'  href='/wp-content/plugins/escalade/assets/css/owl.carousel.css?ver=4.9.8' type='text/css' media='all' />
<script type="text/javascript" src="/wp-content/plugins/escalade/assets/js/owl.carousel.js?ver=4.9.8"></script>
<script type="text/javascript">
 $(function () {
    $(".owl-carousel").owlCarousel({
        pagination: !1,
        autoPlay: 4e3,
        autoplayHoverPause: !0,
        singleItem: !0,
        smartSpeed: 1e3,
        navigation: !0,
        navigationText: ['<', '>']
    });
   $('html, body').animate({scrollTop: $("#choose_services").offset().top }, 200, 'linear');
     $(".add_service").click(function(){
        var _this = $(this); var id = _this.attr("name");
        var quantity = $('.quality_'+id).val();
        $.get(_this.attr("href")+'&quantity='+quantity, function(data){
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
                        <?php if(isset($_SESSION['cart']['extra_services']) && $_SESSION['cart']['extra_services']) : ?>
                            <?php foreach($_SESSION['cart']['extra_services'] as $ex): ?>
                            <div class="box item">
                                <span class="info"><?php echo  $ex['title']; ?> x <?php echo $ex['quantity']; ?></span>
                                <span class="modify"><a href="/extra-services?id_accommdation=<?php echo $_SESSION['cart']['accommodation']['id']; ?>">MODIFY</a></span>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="box_checkout">
                        <a href="/checkout">PROCESS CHECK OUT</a>
                    </div>
                </div>
                <?php if($extra_services): ?>
                <div class="col-md-7 col-lg-7 col-md-xs-12 slide_services">
                    <div class="owl-carousel accomd-modations-slide_room owl-carousel owl-theme owl-loaded">
                        <?php foreach($extra_services as $service): ?>
                            <?php
                                $image_id = get_post_meta($service->ID, 'images', true );
                                $price = get_post_meta($service->ID, 'price', true );
                                $tax = get_post_meta($service->ID, 'tax', true );
                                $quantity = get_post_meta($service->ID, 'quantity', true );
                            ?>
                        <div class="items item-1">
                            <div class="img-thumb">
                                <?php
                                if($image_id){
                                    echo wp_get_attachment_image($image_id, 'full');
                                } else {
                                    echo '<img src="/wp-content/plugins/escalade/assets/images/b1.png" alt="">';
                                }
                                ?>
                            </div>
                            <div class="content">
                                <div class="c-left">
                                    <h2 class="title"><?php echo  $service->post_title; ?></h2>
                                    <?php echo $service->post_content; ?>
                                    <!--<input type="text" required name="date_from" class="awe-calendar select_date" placeholder="SELECT DATE" style="color:#fff;">-->
                                    <input type="number" required name="quality" class="quality_<?php echo $service->ID; ?>" value="1" placeholder="QUALITY">
                                </div>
                                <div class="c-right">
                                    <div class="t1"><?php echo $price; ?></div>
                                    <div class="t2">Excluding Taxs & Fees</div>
                                    <hr />
                                    <!--<div class="t2">Room Changes: <b>01 USD</b></div>-->
                                    <div class="t2">Tax: <b><?php echo $tax; ?> USD</b></div>
                                    <!--<div class="t2">Quality: <b>01</b></div>-->
                                    <hr />
                                    <div class="t3">Total Rates: <b><?php echo $price + $tax; ?> USD</b></div>
                                </div>
                                <div class="add-button">
                                    <a href="/ajax-choose-extra-service?id=<?php echo $service->ID; ?>" onclick="return false;" name="<?php echo $service->ID; ?>" class="btn add_service">ADDED</a>
                                    <!--<button type="button" class="btn add_service">ADDED</button>-->
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
