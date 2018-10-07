<?php
namespace Controllers;
use Controllers\CategoryController;
class ExtraServiceCategoryController extends CategoryController{
	function register(){
		add_action('init', array($this, 'add_custom_taxonomies'), 0 );
		add_action('extra_service_category_add_form_fields',array($this, 'add_category_image'), 10, 2 );
		add_action('created_extra_service_category', array ( $this, 'save_category_image' ), 10, 2 );
		add_action('extra_service_category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
		add_action('extra_service_category_service', array ( $this, 'updated_category_image' ), 10, 2 );
		add_action('admin_enqueue_scripts', array( $this, 'load_media' ) );
		add_action('admin_footer',array($this, 'add_script'));
	}

	function add_custom_taxonomies() {
		register_taxonomy('extra_service_category', 'post', array(
			'hierarchical' => 	true,
			'labels' => array(
		      'name' => _x( 'Extra Service Category', 'taxonomy general name' ),
		      'singular_name' => _x( 'Extra Service Category', 'taxonomy singular name' ),
		      'search_items' =>  __( 'Search Extra Service' ),
		      'all_items' => __( 'All Extra Service Category' ),
		      'parent_item' => __( 'Parent Extra Service Category' ),
		      'parent_item_colon' => __( 'Parent Extra Service Category:' ),
		      'edit_item' => __( 'Edit Extra Service Category' ),
		      'update_item' => __( 'Update Extra Service Category' ),
		      'add_new_item' => __( 'Add New Extra Service Category' ),
		      'new_item_name' => __( 'New Extra Service Category' ),
		      'menu_name' => __( 'EX Category' ),
		    ),
	    	'rewrite' => array(
		    	'slug' => 'escalade-extra-service-category',
		    	'with_front' => false,
		    	'hierarchical' => true 
	    	),
	    	'show_in_menu'       => false,
	  	));
	}

}