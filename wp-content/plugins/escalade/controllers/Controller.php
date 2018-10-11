<?php
namespace Controllers;

class Controller {
	public $plugin_path;
	public $plugin_url;
	public $plugin;

	public function __construct(){

		$this->plugin_path = plugin_dir_path( dirname( __FILE__) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__) );
		$this->plugin = plugin_basename( dirname( __FILE__) ) . '/escalade-plugin.php';
	}

	function register(){
		add_action('admin_menu', array($this, 'admin_menu_page'));
		add_action('admin_menu', array($this, 'admin_submenu_page'));
		add_action('admin_menu', array($this, 'change_link'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue'));
		add_shortcode("escalade_book_form", array($this,"escalade_book_form"));
		add_shortcode("list_accommodation", array($this,"list_accommodation"));
		add_shortcode("check_avaibility", array($this,"check_avaibility"));
		add_shortcode("extra_service_category", array($this,"extra_service_category"));
		add_shortcode("choose_extra_service", array($this,"choose_extra_service"));
		add_shortcode("ajax_choose_extra_service", array($this,"ajax_choose_extra_service"));
		add_shortcode("checkout", array($this,"checkout"));
		add_shortcode("checkout_confirm", array($this,"checkout_confirm"));
	}

	function admin_menu_page(){
		$page_title = 'Escalade';
		$menu_title = 'Escalade';
		$capability = 'manage_options';
		$menu_slug  = 'escalade';
		$function   = array($this, 'admin_page');
		$icon_url   = 'dashicons-palmtree';
		$position   = 100;
		add_menu_page($page_title,$menu_title, $capability, $menu_slug, $function, $icon_url, $position);
	}

	function admin_page(){
		return require_once("$this->plugin_path/views/dashboard.php");
	}

	function admin_submenu_page(){
		$menu = array(
			array(
				'parent_slug' => 'escalade',
				'page_title' => 'Location',
				'menu_title' => 'Location',
				'capability' => 'edit_posts',
				'menu_slug' => 'edit-tags.php?post_type=test_post',
				'callback' => array($this, 'location'),
				1
			),
			array(
				'parent_slug' => 'escalade',
				'page_title' => 'Accommodation Category',
				'menu_title' => 'Acc Category',
				'capability' => 'manage_options',
				'menu_slug' => 'escalade-accommodation-category',
				'callback' => array($this, 'accommodation_category')
			),
			array(
				'parent_slug' => 'escalade',
				'page_title' => 'Extra Services Category',
				'menu_title' => 'EX Category',
				'capability' => 'manage_options',
				'menu_slug' => 'escalade-extra-services-category',
				'callback' => array($this, 'extra_services_category')
			),
			array(
				'parent_slug' => 'escalade',
				'page_title' => 'Extra Services',
				'menu_title' => 'Extra Services',
				'capability' => 'manage_options',
				'menu_slug' => 'escalade-extra-services',
				'callback' => array($this, 'extra_services')
			),
			array(
				'parent_slug' => 'escalade',
				'page_title' => 'Accommodation',
				'menu_title' => 'Accommodation',
				'capability' => 'manage_options',
				'menu_slug' => 'escalade-accommodation',
				'callback' => array($this, 'accommodation')
			),
			array(
				'parent_slug' => 'escalade',
				'page_title' => 'Experiences',
				'menu_title' => 'Experiences',
				'capability' => 'manage_options',
				'menu_slug' => 'escalade-experiences',
				'callback' => array($this, 'experiences')
			)
		);

		if($menu){
			foreach($menu as $m){
				add_submenu_page($m['parent_slug'],$m['page_title'],$m['menu_title'],$m['capability'],$m['menu_slug'],$m['callback']);
			}
		}
		/*add_submenu_page(
			'escalade',
			"SUB",
			"SUB",
			'manage_options',
			admin_url('edit-tags.php?taxonomy=extra_service_category')
		);*/
	}
	function change_link() {
	    global $submenu;
	    $submenu['escalade'][1][2] = 'edit-tags.php?taxonomy=location_category';
	    $submenu['escalade'][2][2] = 'edit-tags.php?taxonomy=accommodation_category';
	    $submenu['escalade'][3][2] = 'edit-tags.php?taxonomy=extra_service_category';
	    $submenu['escalade'][4][2] = 'edit.php?post_type=extra_service';
	    $submenu['escalade'][5][2] = 'edit.php?post_type=accommodation';
	    $submenu['escalade'][6][2] = 'edit.php?post_type=experiences';
	}

	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_script('escalade', $this->plugin_url.'assets/js/script.js' );
	}

	function escalade_book_form(){
		wp_enqueue_style('escalade', $this->plugin_url.'assets/css/style.css' );
		require_once("$this->plugin_path/views/book_form.php");
	}

	function list_accommodation(){
		require_once("$this->plugin_path/views/list_accommodation.php");
	}

	function check_avaibility(){
		require_once("$this->plugin_path/views/check_avaibility.php");
	}

	function extra_service_category(){
		require_once("$this->plugin_path/views/extra_service_category.php");
	}

	function ajax_choose_extra_service(){
		$cart = $_SESSION['cart'];
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
		$arr = isset($cart['extra_services']) ? $cart['extra_services'] : array();
		$post = get_post($id);
		$price = get_post_meta($post->ID, 'price', true);
		$tax = get_post_meta($post->ID, 'tax', true);
		$arr[] = array(
            'id' => intval($post->ID),
            'title' => $post->post_title,
            'quantity' => $quantity,
            'price' => doubleval($price),
            'tax' => doubleval($tax)
        );
        $cart['extra_services'] = $arr;
        $_SESSION['cart'] = $cart;
        //var_dump($cart);
		echo '<div class="box item">
            <span class="info">'.$post->post_title.' x'.$quantity.'</span>
            <span class="modify"><a href="/extra-services/?id_accommodation='.$cart['accommodation']['id'].'">MODIFY</a></span>
        </div>';
	}

	function choose_extra_service(){
		require_once("$this->plugin_path/views/choose_extra_service.php");
	}

	function convert_date($date){
      $a = explode("/", $date);
      return date("Y-m-d", mktime(0,0,0,$a[0],$a[1],$a[2]));
    }

    function checkout(){
    	require_once("$this->plugin_path/views/checkout.php");
    }

    function checkout_confirm(){
    	global $wpdb;
    	$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';
        if($cart){
        	$guest = array(
                'title' => isset($_POST['guest_title']) ? $_POST['guest_title'] : '',
                'first_name' => isset($_POST['guest_firstname']) ? $_POST['guest_firstname'] : '',
                'last_name' => isset($_POST['guest_lastname']) ? $_POST['guest_lastname'] : '',
                'id_number' => isset($_POST['guest_idnumber']) ? $_POST['guest_idnumber'] : '',
                'email' => isset($_POST['guest_email']) ? $_POST['guest_email'] : '',
            );
            $addition = array(
                'title' => isset($_POST['add_title']) ? $_POST['add_title'] : '',
                'first_name' => isset($_POST['add_firstname']) ? $_POST['add_firstname'] : '',
                'last_name' => isset($_POST['add_lastname']) ? $_POST['add_lastname'] : '',
                'id_number' => isset($_POST['add_idnumber']) ? $_POST['add_idnumber'] : '',
                'email' => isset($_POST['add_email']) ? $_POST['add_email'] : '',
            );
            $address = array(
                'country' => isset($_POST['country']) ? $_POST['country'] : '',
                'city' => isset($_POST['city']) ? $_POST['city'] : '',
                'address' => isset($_POST['address']) ? $_POST['address'] : '',
                'phonenumber' => isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '',
            );
            $payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';
            $cart['info'] = array($guest, $addition, $address, 'payment' => $payment_type);
            $data = serialize($cart);
            $arrival = $this->convert_date($cart['arrival']);
            $departure = $this->convert_date($cart['departure']);
        	$wpdb->insert(
    			$wpdb->prefix.'booking',
    			array(
                    'id_location' => intval($cart['id_location']),
                    'id_accommodation' => intval($cart['accommodation']['id']),
    				'contents' => $data,
    				'arrival' => $arrival,
    				'departure' => $departure,
    				'created_at' => date("Y-m-d"),
    				'updated_at' => date("Y-m-d")
    			),
    			array( '%s', '%s', '%s', '%s', '%s' )
    		);

            //send email
            $to = $guest['email'];
            $subject = 'ESCALADE BOOKING';
            $content = '';
            $content .= '
                <h2>YOU STAY</h2>
                <p>'.$cart['accommodation']['title'].'</p>
            ';
            if(isset($cart['extra_services']) && $cart['extra_services']){
                $content .= '<h2>YOU EXPERIENCES</h2>';
                foreach($cart['extra_services'] as $ex){
                    $content .= '<p>'.$ex['title'].' x'.$ex['quantity'].'</p>';
                }
            }
            $content .= '<p>------------------------------------------</p>';
            $content .= '<h5>Thanks for your booking</h5>';
            $headers = array('Content-Type: text/html; charset=UTF-8','From: info@escalade.com.vn');
            wp_mail($to, $subject, $content, $headers);
            unset($_SESSION['cart']);
        }
    }

}
