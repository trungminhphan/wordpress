<?php
namespace Controllers;

class AccommodationCategoryController extends CategoryController {
	function register(){
		add_action('init', array($this, 'add_custom_taxonomies'), 0 );
		add_action('accommodation_category_add_form_fields',array($this, 'add_category_image'), 10, 2 );
		add_action('created_accommodation_category', array ( $this, 'save_category_image' ), 10, 2 );
		add_action('accommodation_category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
		add_action('accommodation_category_service', array ( $this, 'updated_category_image' ), 10, 2 );
		add_action('admin_enqueue_scripts', array( $this, 'load_media' ) );
		add_action('admin_footer',array($this, 'add_script'));
	}

	function add_custom_taxonomies() {
		register_taxonomy('accommodation_category', 'post', array(
			'hierarchical' => 	true,
			'labels' => array(
		      'name' => _x( 'Accommodation Category', 'taxonomy general name' ),
		      'singular_name' => _x( 'Accommodation Category', 'taxonomy singular name' ),
		      'search_items' =>  __( 'Search Accommodation Category' ),
		      'all_items' => __( 'All Accommodation Category' ),
		      'parent_item' => __( 'Parent Accommodation Category' ),
		      'parent_item_colon' => __( 'Parent Accommodation Category:' ),
		      'edit_item' => __( 'Edit Accommodation Category' ),
		      'update_item' => __( 'Update Accommodation Category' ),
		      'add_new_item' => __( 'Add New Accommodation Category' ),
		      'new_item_name' => __( 'New Accommodation Category' ),
		      'menu_name' => __( 'ACC Category' ),
		    ),
	    	'rewrite' => array(
		    	'slug' => 'escalade-accommodation-category',
		    	'with_front' => false,
		    	'hierarchical' => true 
	    	),
	  	));
	}
}