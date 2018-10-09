<?php
namespace Controllers;

class AccommodationCategoryController extends CategoryController {

	function register(){
		add_action('init', array($this, 'add_custom_taxonomies'), 0 );
		/*add_action('restrict_manage_posts', array($this, 'pippin_add_taxonomy_filters' ));
		add_action('accommodation_category_add_form_fields',array($this, 'add_category_image'), 10, 2 );
		add_action('created_accommodation_category', array ( $this, 'save_category_image' ), 10, 2 );
		add_action('accommodation_category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
		add_action('accommodation_category_service', array ( $this, 'updated_category_image' ), 10, 2 );
		add_action('admin_enqueue_scripts', array( $this, 'load_media' ) );
		add_action('admin_footer',array($this, 'add_script'));*/
		add_filter('manage_edit-accommodation_category_columns' , array($this,'custom_taxonomy_columns'));
		add_filter('manage_accommodation_category_custom_column', array($this,'custom_taxonomy_columns_content'), 10, 3 );
	}

	function custom_taxonomy_columns( $columns )
	{
		 $columns = array(
	      'cb' => $columns['cb'],
	      'images' => __( 'Images' ),
	      'name' => __( 'Name' ),
	      'slug' => __( 'Slug'),
	      'count' => __( 'Count')
	    );
		return $columns;
	}

	function custom_taxonomy_columns_content( $content, $column_name, $term_id ){
	   $content = $term_id;
		if('images' == $column_name){
			$img = get_term_meta($term_id);
			if($img){
				echo wp_get_attachment_image($img['images'][0], 'thumbnail');
			}
		}
		if('name' == $column_name){
			$t = get_term($term_id);
			echo $t;
		}
		if('count' == $column_name){
			/*$p = get_post_meta(451);
			var_dump($p['category']);*/
			$query_args_meta = array(
			    'posts_per_page' => -1,
			    'post_type' => 'accommodation',
			    'meta_query' => array(
			        'relation' => 'AND',
			        array(
			            'key' => 'category',
			            'value' => $term_id,
			            'compare' => 'LIKE'
			        )
			    )
			);
			$p = get_posts($query_args_meta);
			echo count($p);
		}

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
		    	'slug' => 'accommodation_category',
		    	'with_front' => false,
		    	'hierarchical' => true 
	    	),
	  	));
	}

	function pippin_add_taxonomy_filters() {
		global $typenow;
		// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
		$taxonomies = array('bay-view-deluxe-bungalow');
		
		// must set this to the post type you want the filter(s) displayed on
		if( $typenow == 'accommodation' ){
			foreach ($taxonomies as $tax_slug) {
				$tax_obj = get_taxonomy($tax_slug);
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if(count($terms) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>Show All $tax_name</option>";
					foreach ($terms as $term) { 
						echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
					}
					echo "</select>";
				}
			}
		}
	}

}