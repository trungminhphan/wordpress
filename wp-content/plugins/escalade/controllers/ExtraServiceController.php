<?php
namespace Controllers;

class ExtraServiceController {
	// id, title, image, id_category
	function register(){
		add_action('init', array($this, 'register_post_type'));
		add_filter( 'manage_extra_service_posts_columns', array($this,'smashing_extra_service_columns' ));
		add_action( 'manage_extra_service_posts_custom_column', array($this,'smashing_extra_service_column'), 10, 2);
	}

	function register_post_type() {
		$labels = array(
			'name'               => __( 'Extra services'),
			'singular_name'      => __( 'Extra services'),
			'menu_name'          => __( 'Extra services'),
			'name_admin_bar'     => __( 'Extra services'),
			'add_new'            => __( 'Add New'),
			'add_new_item'       => __( 'Add New Extra services'),
			'new_item'           => __( 'New Extra services'),
			'edit_item'          => __( 'Edit Extra services'),
			'view_item'          => __( 'View Extra services'),
			'all_items'          => __( 'All Extra services'),
			'search_items'       => __( 'Search Extra services'),
			'parent_item_colon'  => __( 'Parent Extra services:'),
			'not_found'          => __( 'No Extra services found.'),
			'not_found_in_trash' => __( 'No Extra services found in Trash.')
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Description.', 'Extra services' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'extra_service'),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'price'),
			'show_in_menu'       => false,
		);
		register_post_type('extra_service', $args);
	}

	function smashing_extra_service_columns( $columns ) {
	    $columns = array(
	      'cb' => $columns['cb'],
	      'image' => __( 'Image' ),
	      'title' => __( 'Title' ),
	      'price' => __( 'Price', 'smashing' ),
	      'tax' => __( 'Tax', 'smashing' ),
	      'category' => __( 'Category', 'smashing' ),
	    );
	  return $columns;
	}

	function smashing_extra_service_column( $column, $post_id ) {
		  // Image column
		  if ( 'image' === $column ) {
		    echo get_the_post_thumbnail( $post_id, array(80, 80) );
		  }

		  if ('price' === $column ) {
		    $price = get_post_meta( $post_id, 'price', true );
		    if ( ! $price ) {
		      _e( 'n/a' );
		    } else {
		      echo '$ ' . number_format( $price, 0, '.', ',' );
		    }
		  }

		if ('tax' === $column ) {
		    $tax = get_post_meta($post_id, 'tax', true );
		    if ( ! $tax ) {
		      _e( 'n/a' );
		    } else {
		      echo '$ ' . number_format( $tax, 0, '.', ',' );
		    }
		}
		if ('category' === $column ) {
		    $category = get_post_meta($post_id, 'category', true );
		    $arr = array();
		    if($category){
		    	foreach($category as $c){
		    		$cat = get_term_by('id', $c, 'extra_service_category');
		    		$arr[] =  $cat->name;
		    	}
		    }

		    if($arr) echo implode(", ", $arr);
		}
	}
}
