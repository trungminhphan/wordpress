<?php 
namespace Controllers;
use Controllers\CategoryController;
class LocationController extends CategoryController {
	function register(){
		add_action('init', array($this, 'add_custom_taxonomies'), 0 );
		add_action('category_add_form_fields',array($this, 'add_category_image'), 10, 2 );
		add_action('created_category', array ( $this, 'save_category_image' ), 10, 2 );
		add_action('category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
		add_action('edited_category', array ( $this, 'updated_category_image' ), 10, 2 );

		add_action( 'location_category_add_form_fields', array( $this, 'add_category_image' ), 10, 2 );
	    add_action( 'created_location_category', array( $this, 'save_category_image' ), 10, 2 );
	    add_action( 'location_category_edit_form_fields', array( $this, 'update_category_image' ), 10, 2 );
	    add_action( 'edited_location_category', array( $this, 'updated_category_image' ), 10, 2 );

		add_action('admin_enqueue_scripts', array( $this, 'load_media' ) );
		add_action('admin_footer',array($this, 'add_script'));
	}

	function add_custom_taxonomies() {
	  // Add new "Locations" taxonomy to Posts
		register_taxonomy('location_category', 'post', array(
		  'hierarchical' => true,
		  'labels' => array(
	      'name' => _x( 'Locations', 'taxonomy general name' ),
	      'singular_name' => _x( 'Location', 'taxonomy singular name' ),
	      'search_items' =>  __( 'Search Locations' ),
	      'all_items' => __( 'All Locations' ),
	      'parent_item' => __( 'Parent Location' ),
	      'parent_item_colon' => __( 'Parent Location:' ),
	      'edit_item' => __( 'Edit Location' ),
	      'update_item' => __( 'Update Location' ),
	      'add_new_item' => __( 'Add New Location' ),
	      'new_item_name' => __( 'New Location Name' ),
	      'menu_name' => __( 'Locations' ),
	    ),
	    'rewrite' => array(
	      'slug' => 'locations',
	      'with_front' => false,
	      'hierarchical' => true 
	    ),
	  ));
	}
}