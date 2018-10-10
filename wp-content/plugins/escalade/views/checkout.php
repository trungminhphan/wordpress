<?php
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';
//var_dump($cart);
//$data = maybe_serialize($cart);
//$data = serialize($cart);
//echo $data;
//echo '<hr />';
//$un = maybe_unserialize($data);
//$un = unserialize($data);
//var_dump($un);
$total_extra = 0;
if(isset($cart['extra_services']) && $cart['extra_services']){
    foreach($cart['extra_services'] as $s){
        $total_extra += ($s['price']+$s['tax'])*$s['quantity'];
    }
}
?>
<link rel='stylesheet' id='escalade-css'  href='/wp-content/plugins/escalade/assets/css/responsive.css?ver=4.9.8' type='text/css' media='all' />
<script type="text/javascript">
 $(function () {
    $('html, body').animate({scrollTop: $("#checkout").offset().top }, 2000, 'linear');
});
</script>
<form action="/checkout-confirm" method="POST">
<section class="checkout" id="checkout">
    <div class="container">
        <div class="contact">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-md-xs-12">
                    <div class="title-1">CHECK</div>
                    <div class="title-2">OUT</div>
                    <div class="box_active">
                        <span class="info">YOU STAY</span>
                        <span class="modify">TOTAL: <?php echo $cart['accommodation']['price']*$cart['accommodation']['tax']; ?> USD</span>
                    </div>
                    <?php if($cart && $cart['accommodation']): ?>
                        <div class="box">
                            <span class="info"><a href=""><?php echo $cart['accommodation']['title']; ?></a></span>
                            <span class="modify"><a href="/">MODIFY</a></span>
                        </div>
                    <?php endif; ?>
                    <div class="box_active">
                        <span class="info">YOU EXPERIENCES</span>
                        <span class="modify">TOTAL: <?php echo $total_extra;?> USD</span>
                    </div>
                    <?php if(isset($cart['extra_services']) && $cart['extra_services']): ?>
                        <?php foreach($cart['extra_services'] as $s): ?>
                            <div class="box">
                                <span class="info"><a href=""><?php echo $s['title'];?> x<?php echo $s['quantity'];?></a></span>
                                <span class="modify"><a href="/">MODIFY</a></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="box_checkout">
                        <!--<a href="/checkout-confirm" >PROCESS PAYMENT</a>-->
                        <button type="submit" name="process_payment" id="process_payment">PROCESS PAYMENT</button>
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-md-xs-12 check-info">
                    <div class="checkout_form">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="box-title">GUEST INFORMATION</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-4 col-sm-12">
                                <select required="required" class="awe-select white" name="guest_title">
                                    <option value="">TITLE</option>
                                    <option value="MR">MR</option>
                                    <option value="MS">MS</option>
                                </select>
                            </div>
                            <div class="col-xs-4 col-sm-4">
                                <input type="text" class="field-text" name="guest_firstname" required placeholder="FIRST NAME">
                            </div>
                            <div class="col-xs-4 col-sm-4">
                                <input type="text" class="field-text" name="guest_lastname" required placeholder="LAST NAME">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4">
                                <input type="text" class="field-text" name="guest_idnumber" required placeholder="ID NUMBER">
                            </div>
                            <div class="col-xs-8 col-sm-8">
                                <input type="text" class="field-text" name="guest_email" required placeholder="EMAIL">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="box-title">ADDITION GUEST INFORMATION</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-4 col-sm-12">
                                <select class="awe-select white" name="add_title">
                                    <option value="">TITLE</option>
                                    <option value="MR">MR</option>
                                    <option value="MS">MS</option>
                                </select>
                            </div>
                            <div class="col-xs-4 col-sm-4">
                                <input type="text" class="field-text" name="add_firstname" placeholder="FIRST NAME">
                            </div>
                            <div class="col-xs-4 col-sm-4">
                                <input type="text" class="field-text" name="add_lastname" placeholder="LAST NAME">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4">
                                <input type="text" class="field-text" name="add_idnumber" placeholder="ID NUMBER">
                            </div>
                            <div class="col-xs-8 col-sm-8">
                                <input type="text" class="field-text" name="add_email" placeholder="EMAIL">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="box-title">ADDRESS</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6">
                                <input type="text" class="field-text" name="country" required placeholder="COUNTRY">
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <input type="text" class="field-text" name="city" required placeholder="CITY">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6">
                                <input type="text" class="field-text" name="address" required placeholder="ADDRESS">
                            </div>
                            <div class="col-xs-6 col-sm-6">
                                <input type="text" class="field-text" name="phonenumber"  placeholder="PHONE NUMBER">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="box-title">PAYMENT INFORMATION</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <select class="awe-select white" name="payment_type" required>
                                    <option>PAYMENT TYPE</option>
                                    <option>VISA</option>
                                    <option>CREDIT CARD</option>
                                    <option>CASH</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ABOUT -->
</form>
