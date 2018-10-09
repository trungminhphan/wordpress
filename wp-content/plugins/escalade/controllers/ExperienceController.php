<?php
namespace Controllers;

class ExperienceController{

	function register(){
		add_action('init', array($this, 'register_post_type'));
		add_filter( 'manage_experiences_posts_columns', array($this,'smashing_experiences_columns' ));
		add_action( 'manage_experiences_posts_custom_column', array($this,'smashing_experiences_column'), 10, 2);
	}

	function register_post_type() {
		$labels = array(
			'name'               => __( 'Experiences'),
			'singular_name'      => __( 'Experiences'),
			'menu_name'          => __( 'Experiences'),
			'name_admin_bar'     => __( 'Experiences'),
			'add_new'            => __( 'Add New'),
			'add_new_item'       => __( 'Add New Experiences'),
			'new_item'           => __( 'New Experiences'),
			'edit_item'          => __( 'Edit Experiences'),
			'view_item'          => __( 'View Experiences'),
			'all_items'          => __( 'All Experiences'),
			'search_items'       => __( 'Search Experiences'),
			'parent_item_colon'  => __( 'Parent Experiences:'),
			'not_found'          => __( 'No Experiences found.'),
			'not_found_in_trash' => __( 'No Experiences found in Trash.')
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Description.', 'experiences' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'experience' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields'),
			'show_in_menu'       => false,
		);
		register_post_type('experiences', $args );
	}

	function smashing_experiences_columns( $columns ) {
	    $columns = array(
	      'cb' => $columns['cb'],
	      'image' => __( 'Image' ),
	      'title' => __( 'Title' ),
	      'price' => __( 'Price', 'smashing' ),
	      'tax' => __( 'Tax', 'smashing' ),
	    );
	  return $columns;
	}

	function smashing_experiences_column( $column, $post_id ) {
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
	}
}
