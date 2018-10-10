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
		var_dump($cart);
	}

	function choose_extra_service(){
		require_once("$this->plugin_path/views/choose_extra_service.php");
	}

	function convert_date($date){
      $a = explode("/", $date);
      return date("Y-m-d", mktime(0,0,0,$a[0],$a[1],$a[2]));
    }

}
