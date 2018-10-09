<?php
namespace Controllers;

class AccommodationController {
	function register(){
		add_action('init', array($this, 'register_post_type'));
		add_filter( 'manage_accommodation_posts_columns', array($this,'smashing_accommodation_columns' ));
		add_action( 'manage_accommodation_posts_custom_column', array($this,'smashing_accommodation_column'), 10, 2);
	}

	function register_post_type() {
		$labels = array(
			'name'               => __( 'Accommodation'),
			'singular_name'      => __( 'Accommodation'),
			'menu_name'          => __( 'Accommodation'),
			'name_admin_bar'     => __( 'Accommodation'),
			'add_new'            => __( 'Add New'),
			'add_new_item'       => __( 'Add New Accommodation'),
			'new_item'           => __( 'New Accommodation'),
			'edit_item'          => __( 'Edit Accommodation'),
			'view_item'          => __( 'View Accommodation'),
			'all_items'          => __( 'All Accommodation'),
			'search_items'       => __( 'Search Accommodation'),
			'parent_item_colon'  => __( 'Parent Accommodation:'),
			'not_found'          => __( 'No Accommodation found.'),
			'not_found_in_trash' => __( 'No Accommodation found in Trash.')
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Description.', 'Accommodation' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'acc' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields'),
			'show_in_menu'       => false,
		);
		register_post_type( 'accommodation', $args );
	}

	function smashing_accommodation_columns( $columns ) {
	    $columns = array(
	      'cb' => $columns['cb'],
	      'image' => __( 'Image' ),
	      'title' => __( 'Title' ),
	      'price' => __( 'Price', 'smashing' ),
	      'tax' => __( 'Tax', 'smashing' ),
	      'category' => __( 'Category', 'smashing' ),
	      'quantity' => __( 'Quantity' ),
	    );
	  return $columns;
	}

	function smashing_accommodation_column( $column, $post_id ) {
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
		    		$cat = get_term_by('id', $c, 'accommodation_category');
		    		$arr[] =  $cat->name;
		    	}
		    }
		    if($arr) echo implode(", ", $arr);
		}
		if ('quantity' === $column ) {
		    $quantity = get_post_meta($post_id, 'quantity', true );
		    if ( ! $quantity ) {
		      _e( 'n/a' );  
		    } else {
		      echo number_format( $quantity, 0, '.', ',' );
		    }
		}
	}
}