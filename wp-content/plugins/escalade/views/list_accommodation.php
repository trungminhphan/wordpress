<?php
//echo get_the_ID();
//page 420 = term 9
//page 421 = term 10
// page 422 = term 11
$page_id = get_the_ID();
$cat = 9;
if($page_id == 420) $cat = 9;
if($page_id == 421) $cat = 10;
if($page_id == 421) $cat = 11;
$query_args_meta = array(
    'posts_per_page' => -1,
    'post_type' => 'accommodation',
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'category',
            'value' => $cat,
            'compare' => 'LIKE'
        )
    )
);
$posts = get_posts($query_args_meta);
//var_dump($posts);
?>
<section class="section-room bg-white">
    <div class="container">
        <div class="room-wrap-1">
            <div class="row">
                <?php if($posts): ?>
                <?php foreach($posts as $post): ?>
                <?php
					//$meta = get_post_meta($post->ID);
                    $post_type_data = get_post_type_object( $post->post_type );
                    $slug = $post_type_data->rewrite['slug'] . '/'. $post->post_name;
					$image_id = get_post_meta($post->ID, 'images', true );
					$price = get_post_meta($post->ID, 'price', true );
					$tax = get_post_meta($post->ID, 'tax', true );
					$quantity = get_post_meta($post->ID, 'quantity', true );
                    $description = get_post_meta($post->ID, 'description', true );
				?>
                <div class="col-md-6">
                    <div class="room_item-1">
                        <h2><a href="/<?php echo $slug; ?>"><?php echo $post->post_title; ?></a></h2>
                        <a href="/<?php echo $slug; ?>">
                        <div class="img">
                            <?php
                            if($image_id) {
					           echo wp_get_attachment_image($image_id, 'full');
					        } else {
                                echo '<img src="/wp-content/plugins/escalade/assets/images/b1.png" alt="">';
                            }
                            ?>
                        </div>
                        </a>
                        <div class="desc">
                            <?php echo $description; ?>
                        </div>
                        <div class="bot">
                            <span class="price">Price <span class="amout">$<?php echo $price; ?></span></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
               <?php endif; ?>
            </div>
        </div>
    </div>
</section>


