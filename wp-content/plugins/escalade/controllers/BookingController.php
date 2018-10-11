<?php
namespace Controllers;

class BookingController {

    function register(){
        add_action('admin_menu', array($this, 'add_menu_booking'));
    }

    function add_menu_booking(){
        add_submenu_page( 'escalade', 'Booking', 'Booking', 'manage_options', 'booking', array($this, 'booking_list'));
    }

    function booking_list(){
        $path = plugin_dir_path( dirname( __FILE__) );
        require_once($path . "/views/booking_list.php");
    }
}
