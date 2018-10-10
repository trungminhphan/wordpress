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
    $('html, body').animate({scrollTop: $("#choose_room").offset().top }, 2000, 'linear');
});
</script>
<section class="choose-room" id="choose_room">
    <div class="container">
        <div class="contact">
            <div class="row">
                <?php
                function format_date($date){
                  $a = explode("/", $date);
                  return date("l, M d, Y", mktime(0,0,0,$a[0],$a[1],$a[2]));
                }

                $accommodation = get_posts(array('post_type' => 'accommodation'));
                $id_location = isset($_GET['id_location']) ? $_GET['id_location'] : (isset($_SESSION['cart']['id_location']) ? $_SESSION['cart']['id_location'] : '');
                if($id_location){
                    $term = get_term_by('id', $id_location, 'location_category');
                    $location_name = $term->name;
                } else { $location_name ='';}
                $arrival = isset($_GET['arrival']) ? $_GET['arrival'] : (isset($_SESSION['cart']['arrival']) ? $_SESSION['cart']['arrival'] : date("m/d/Y"));
                $departure = isset($_GET['departure']) ? $_GET['departure'] : (isset($_SESSION['cart']['departure']) ? $_SESSION['cart']['departure'] : date("m/d/Y"));
                $guest = isset($_GET['departure']) ? $_GET['guest'] : (isset($_SESSION['cart']['guest']) ? $_SESSION['cart']['guest'] : '');
                $cart = array(
                    'id_location' => intval($id_location),
                    'arrival' => $arrival,
                    'departure' => $departure,
                    'guest' => intval($guest)
                );
                $_SESSION['cart'] = $cart;
                ?>
                <div class="col-md-5 col-lg-5 col-md-xs-12">
                    <div class="title-1">ROOM</div>
                    <div class="title-2">& RATES</div>
                    <div class="box_active">
                        <span class="info">CHOOSE YOUR ROOMS</span>
                        <span class="modify"><i class="fa fa-angle-right"></i></span>
                    </div>
                    <div class="box">
                        <span class="info">LOCATION: <?php echo $location_name; ?></span>
                        <span class="modify"><a href="/">MODIFY</a></span>
                    </div>
                    <div class="box">
                        <span class="info">ARRIVAL DATE: <?php echo format_date($arrival); ?></span>
                        <span class="modify"><a href="/">MODIFY</a></span>
                    </div>
                    <div class="box">
                        <span class="info">DEPARTURE DATE: <?php echo format_date($departure); ?></span>
                        <span class="modify"><a href="/">MODIFY</a></span>
                    </div>
                    <div class="box">
                        <span class="info">GUEST: <?php echo $guest; ?></span>
                        <span class="modify"><a href="/">MODIFY</a></span>
                    </div>
                </div>
                <?php if($accommodation): ?>
                <div class="col-md-7 col-lg-7 col-md-xs-12 slide_room">
                    <div class="owl-carousel accomd-modations-slide_room owl-carousel owl-theme owl-loaded">
                        <?php foreach($accommodation as $acc): ?>
                        <?php
                            $image_id = get_post_meta($acc->ID, 'images', true );
                            $price = get_post_meta($acc->ID, 'price', true );
                            $tax = get_post_meta($acc->ID, 'tax', true );
                            $quantity = get_post_meta($acc->ID, 'quantity', true );
                        ?>
                        <div class="items item-1">
                            <div class="img-thumb">
                                <img src="/wp-content/plugins/escalade/assets/images/accommodation.jpg" alt="">
                            </div>
                            <div class="content">
                                <div class="c-left">
                                    <h2 class="title"><?php echo $acc->post_title; ?></h2>
                                    <?php echo $acc->post_content; ?>
                                </div>
                                <div class="c-right">
                                    <div class="t1"><?php echo $price; ?></div>
                                    <div class="t2">Excluding Taxs and Fee</div>
                                    <hr />
                                    <div class="t2">Room Changes: <b><?php echo $price; ?></b></div>
                                    <div class="t2">Tax: <b> <?php echo $tax; ?></b></div>
                                    <div class="t2">Full Board: <b> <?php echo $price + $tax; ?>  USD</b></div>
                                    <hr />
                                    <div class="t3">Total Rates: <b> <?php echo $price + $tax; ?>  USD</b></div>
                                </div>
                            </div>
                            <div class="select-button">
                                <a href="/extra-services/?id_accommodation=<?php echo $acc->ID; ?>" class="btn">SELECT AVAILABLE ROOMS</a>
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
