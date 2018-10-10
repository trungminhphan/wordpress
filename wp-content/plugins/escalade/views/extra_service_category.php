<?php
$extra_service_category = get_terms('extra_service_category', array('hide_empty' => false));
$id_accmmodation = isset($_GET['id_accommodation']) ? $_GET['id_accommodation'] : '';
$post = get_post($id_accmmodation);
$image_id = get_post_meta($post->ID, 'images', true );
$price = get_post_meta($post->ID, 'price', true );
$tax = get_post_meta($post->ID, 'tax', true );
//var_dump($post);

$cart = $_SESSION['cart'];
$cart['accommodation']['id'] = $post->ID;
$cart['accommodation']['title'] = $post->post_title;
$cart['accommodation']['image_id'] = $image_id;
$cart['accommodation']['price'] = $price;
$cart['accommodation']['tax'] = $tax;
$_SESSION['cart'] = $cart;
?>
<link rel='stylesheet' id='escalade-css'  href='/wp-content/plugins/escalade/assets/css/responsive.css?ver=4.9.8' type='text/css' media='all' />
<script type="text/javascript">
 $(function () {
    $('html, body').animate({scrollTop: $("#extra_service").offset().top }, 2000, 'linear');
});
</script>
<section class="extra-services" id="extra_service">
    <div class="container">
        <div class="contact">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-md-xs-12">
                    <div class="title-1">EXPERIENCES</div>
                    <div class="title-2">& MORE</div>
                    <div class="box_active">
                        <span class="info">CHOOSE YOUR TYPE OF EXPERIENCES</span>
                        <span class="modify"><i class="fa fa-angle-right"></i></span>
                    </div>
                    <div class="box">
                        <span class="info"><a href="/checkout">NO THANKS! PROCESS CHECKOUT</a></span>
                    </div>
                </div>
                <?php if($extra_service_category): ?>
                <div class="col-md-7 col-lg-7 col-md-xs-12 list-choose">
                    <div class="box">
                        <?php foreach($extra_service_category as $cat): ?>
                        <div class="item"><a href="/choose-extra-service?id_extra_service_category=<?php echo $cat->term_id;?>"><?php echo $cat->name; ?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
