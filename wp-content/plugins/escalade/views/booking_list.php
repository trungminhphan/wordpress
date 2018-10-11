<?php
global $wpdb;

if(isset($_POST['remove']) && $_POST['remove']){
    $wpdb->delete("{$wpdb->prefix}booking", array( 'id' => $_POST['remove'] ) );
    unset($_POST['remove']);
}

$booking = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}booking", OBJECT );
//var_dump($results);
?>
<h2>Booking</h2>
<table class="wp-list-table widefat fixed striped booking">
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Location</th>
            <th>Accommodation</th>
            <th>Arrial</th>
            <th>Departure</th>
            <th>Extra services</th>
            <th>Total</th>
            <th>#</th>
        </tr>
    </thead>
    <?php if($booking) : ?>
    <tbody>
        <?php foreach($booking as $book): ?>
        <?php
            $total = 0;
            $data = unserialize($book->contents);
            $total += $data['accommodation']['price'] + $data['accommodation']['tax'];
            if($book->id_location){
                $location = get_term_by('id', $book->id_location,'location_category');
                $location_name = $location->name;
            } else { $location_name = ''; }
            $acc = get_post($book->id_accommodation);
        ?>
        <tr>
            <td><?php echo $book->id; ?></td>
            <td><?php echo $data['info'][0]['title'] .' '. $data['info'][0]['first_name'] .' '. $data['info'][0]['last_name']; ?></td>
            <td><?php echo $location_name; ?></td>
            <td><?php echo $acc->post_title; ?></td>
            <td><?php echo $book->arrival; ?></td>
            <td><?php echo $book->departure; ?></td>
            <td>
            <?php
            if(isset($data['extra_services']) && $data['extra_services']) {
                foreach($data['extra_services'] as $ex){
                    $total += $ex['price'] + $ex['tax'];
                    echo '#'.$ex['title'] . ' x'. $ex['quantity'] .'&nbsp;&nbsp;&nbsp;';
                }
            }
            ?>
            </td>
            <td>$<?php echo number_format($total,2,",","."); ?></td>
            <td>
                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="inline-block">
                    <input type="hidden" name="remove" value="<?php echo $book->id; ?>">
                    <?php submit_button('Delete', 'delete small primary', 'submit', false, array(
                        'onclick' => 'return confirm("Are you sure you want to delete this Booking?");'
                    ));?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <?php endif; ?>
</table>
