<?php
namespace Controllers;

class BookingController extends Controller {
    function register(){
        add_action('admin_menu', array($this, 'add_menu_booking'));
    }

    function add_menu_booking(){
        add_submenu_page( 'escalade', 'Booking', 'Booking', 'manage_options', 'booking', array($this, 'booking_list'));
    }

    function booking_list(){
        require_once("$this->plugin_path/views/booking_list.php");
    }
}
