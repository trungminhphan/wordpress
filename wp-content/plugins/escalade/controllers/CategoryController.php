<?php
namespace Controllers;

class CategoryController {
	
	public function load_media() {
		wp_enqueue_media();
	}
	/*
	  * Add a form field in the new category page
	  * @since 1.0.0
	 */
	public function add_category_image($taxonomy) {
	   	echo '<div class="form-field term-group">
		     <label for="category-image-id">'. __('Image').'</label>
		     <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
		     <div id="category-image-wrapper"></div>
		     <p>
		       <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="'. __('Add Image').'" />
		       <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="'. __('Remove Image').'" />
		    </p>
	   	</div>';
 	}

 	/*
	  * Save the form field
	  * @since 1.0.0
	 */
	public function save_category_image($term_id, $tt_id ) {
	   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
	     $image = $_POST['category-image-id'];
	     add_term_meta($term_id,'category-image-id', $image, true );
	   }
	}

	 /*
	  * Edit the form field
	  * @since 1.0.0
	 */
	 public function update_category_image( $term, $taxonomy ){
	   echo '<tr class="form-field term-group-wrap">
	     <th scope="row">
	       <label for="category-image-id">'.__('Image').'</label>
	     </th>
	     <td>';
	      $image_id = get_term_meta($term->term_id, 'category-image-id', true );
	      echo '<input type="hidden" id="category-image-id" name="category-image-id" value="'.$image_id.'">
	       <div id="category-image-wrapper">';
	        if($image_id) {
	           echo wp_get_attachment_image($image_id, 'thumbnail');
	        }
	       echo '</div>
	       <p>
	         <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="'. __('Change Image').'" />
	         <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="'. __( 'Remove Image').'" />
	       </p>
	     </td>
	   </tr>';
	}

	/*
	 * Update the form field value
	 * @since 1.0.0
	 */
	 public function updated_category_image($term_id, $tt_id ) {
	   if(isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
	     $image = $_POST['category-image-id'];
	     update_term_meta($term_id, 'category-image-id', $image);
	   } else {
	     update_term_meta($term_id, 'category-image-id', '');
	   }
	}

	/*
 * Add script
 * @since 1.0.0
 */
 public function add_script() { ?>
   <script>
     jQuery(document).ready( function($) {
       function ct_media_upload(button_class) {
         var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if ( _custom_media ) {
               $('#category-image-id').val(attachment.id);
               $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
            }
         wp.media.editor.open(button);
         return false;
       });
     }
     ct_media_upload('.ct_tax_media_button.button'); 
     $('body').on('click','.ct_tax_media_remove',function(){
       $('#category-image-id').val('');
       $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
     $(document).ajaxComplete(function(event, xhr, settings) {
       var queryStringArr = settings.data.split('&');
       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
         var xml = xhr.responseXML;
         $response = $(xml).find('term_id').text();
         if($response!=""){
           // Clear the thumb image
           $('#category-image-wrapper').html('');
         }
       }
     });
   });
 </script>
 <?php }
}