<?php

	namespace  TheChameleonPageBuilder;	
	/**
	 * Form Helper 
	 * 
	 * 
	 * @author 		Goran Petrovic <goran.petrovic@godev.rs>
	 * @package    	WordPress
	 * @subpackage 	The Chameleon
	 * @since 		The Chameleon 3.1.0
	 *
	 * @version 1.0.0
	 *
	 */
	
	class Form{
		
		/**
		 * 	Input field
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $name -  filed name, format _ or -, filed_name
		 * @var string $value - default value
		 * @var array  $attr  - html attributes
		 *
		 * @return <input type="text" ...>
		 **/
		static function input( $name, $value = '', $attr = array() )
		{ 
			//filetr filed name 
			$id   = str_replace( "-","_", sanitize_title( $name ) ) ;	
			//colect atribute whic is remove in static function attr			
			$id   = !empty( $attr['id'] ) ? $attr['id'] : $id  ;
			$type = !empty( $attr['type'] ) ? $attr['type'] : 'text';
							
			return '<input id="' . esc_attr( $id ) . '" type="' . esc_attr( $type ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" ' . self::attr($attr) . ' >';
				
		}
		
		/**
		 * 	Input field
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $name -  filed name, format _ or -, filed_name
		 * @var string $value - default value
		 * @var array  $attr  - html attributes
		 *
		 * @return <input type="text" ...>
		 **/
		static function textarea( $name, $value = '', $attr = array() ){ 
			//filetr filed name 
			$id   = str_replace( "-","_", sanitize_title( $name ) ) ;	
			//colect atribute whic is remove in static function attr			
			$id   = !empty( $attr['id'] ) ? $attr['id'] : $id  ;
			$type = !empty( $attr['type'] ) ? $attr['type'] : 'text';
							
			return '<textarea id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" ' . self::attr($attr) . ' >'.esc_textarea( $value ).'</textarea>';
				
		}
		
		/**
		 * 	Select box
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $name -  filed name, format _ or -, filed_name
		 * @var string $value - default value
		 * @var array $choices - options for sellect in array 'value' => 'name'
		 * @var array  $attr  - html attributes
		 *
		 * @return <select name=..>
		 **/
		static function select( $name, $value, $choices, $attr = array() ){			
			$id = str_replace( "-","_", sanitize_title( $name ) ) ;
			//colect atribute whic is remove in static function attr			
			$id   = !empty( $attr['id'] ) ? $attr['id'] : $id  ; ?>	
			<select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo self::attr( $attr ) ?> >
				<?php foreach ( $choices as $key => $choice ) : ?>
					<option value="<?php echo esc_attr( $key ) ?>" <?php selected( esc_attr( $value ), $key, 1 );?> ><?php echo esc_attr( $choice ) ?></option>
				<?php endforeach; ?>
			</select>	
			<?php
						
		}
		
		
		/**
		 * 	Image upload 
		 *  http://www.lenslider.com/articles/wordpress-3-5-media-uploader-tips-on-using-it-within-plugins/
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $name -  filed name, format _ or -, filed_name
		 * @var string $value - default value
		 * @var array $choices - options for sellect in array 'value' => 'name'
		 * @var array  $attr  - html attributes
		 *
		 * @return <select name=..>
		 **/
		static function wp_image( $name, $value = '', $attr = array() ){	
			
			//colect atribute whic is remove in static function attr			
			$the_id   = !empty( $attr['id'] ) ? $attr['id'] : str_replace( "-","_", sanitize_title( $name ) ) ; 	?>	

			<input type="hidden" name="<?php echo $name ?>" id="<?php echo $the_id ?>" value="<?php echo $value ?>">

			<!--<a href="javascript:;" class="open_<?php echo $the_id ?>">Open Media Uploader</a>-->

			<span class="wp-picker-input-wrap">
				
				<a tabindex="0" class="wp-color-result open_<?php echo $the_id ?>" title="Select Image" data-current="Select Image" style=""></a>
	
				<input class="button button-small wp-image-clear wp-image-clear_<?php echo $the_id ?> hidden" value="Clear" type="button" data-id="<?php echo $the_id ?>" style="width:80px;">
			</span>

		
				<script type="text/javascript" charset="utf-8">

					jQuery(document).ready(function() {
					   //uploading files variable
					   var custom_file_frame;
					   jQuery(document).on('click', '.open_<?php echo $the_id ?>', function(event) {
					      event.preventDefault();
					      //If the frame already exists, reopen it
					      if (typeof(custom_file_frame)!=="undefined") {
					         custom_file_frame.close();
					      }

					      //Create WP media frame.
					      custom_file_frame = wp.media.frames.customHeader = wp.media({
					         //Title of media manager frame
					         title: "Select Image",
					         library: {
					            type: 'image'
					         },
					         button: {
					            //Button text
					            text: "Insert Image"
					         },
					         //Do not allow multiple files, if you want multiple, set true
					         multiple: false
					      });

					      //callback for selected image
					      custom_file_frame.on('select', function() {
					         var attachment = custom_file_frame.state().get('selection').first().toJSON();
					         //do something with attachment variable, for example attachment.filename
					         //Object:
					         //attachment.alt - image alt
					         //attachment.author - author id
					         //attachment.caption
					         //attachment.dateFormatted - date of image uploaded
					         //attachment.description
					         //attachment.editLink - edit link of media
					         //attachment.filename
					         //attachment.height
					         //attachment.icon - don't know WTF?))
					         //attachment.id - id of attachment
					         //attachment.link - public link of attachment, for example ""http://site.com/?attachment_id=115""
					         //attachment.menuOrder
					         //attachment.mime - mime type, for example image/jpeg"
					         //attachment.name - name of attachment file, for example "my-image"
					         //attachment.status - usual is "inherit"
					         //attachment.subtype - "jpeg" if is "jpg"
					         //attachment.title
					         //attachment.type - "image"
					         //attachment.uploadedTo
					         //attachment.url - http url of image, for example "http://site.com/wp-content/uploads/2012/12/my-image.jpg"
					         //attachment.width
					
					
							 /*  jQuery('img#<?php echo $the_id ?>').attr('src', attachment.url);*/
								
								jQuery('.open_<?php echo $the_id ?>, #the_chameleon_page_builder_section_header').css('background-image', 'url(' + attachment.url + ')');		
								jQuery('.open_<?php echo $the_id ?>, #the_chameleon_page_builder_section_header').css('	background-repeat', 'no-repeat');
								jQuery('.open_<?php echo $the_id ?>, #the_chameleon_page_builder_section_header').css('background-position', 'center center');
								jQuery('.open_<?php echo $the_id ?>, #the_chameleon_page_builder_section_header').css('background-size', 'cover');
								jQuery('input#<?php echo $the_id ?>').attr('value', attachment.url);
								jQuery('.wp-image-clear_<?php echo $the_id ?>').removeClass('hidden');
	
					      });

					      //Open modal
					      custom_file_frame.open();
					   });
					   
					   
					   
					   //remove image
					   jQuery( ".wp-image-clear_<?php echo $the_id ?>" ).click(function() {
					     jQuery( this ).addClass('hidden');
						 jQuery('input#<?php echo $the_id ?>').attr('value', '');
						 jQuery('.open_<?php echo $the_id ?>').css('background-image', 'url()');
					   });
					   
					});
				</script>
				<?php


		       //call for new media manager
		       wp_enqueue_media();

		      //maybe..
		      wp_enqueue_style('media');
				
		}
		
		
		static function color( $name, $value = '', $attr = array() ){	
			
			$the_id   = !empty( $attr['id'] ) ? $attr['id'] : str_replace( "-","_", sanitize_title( $name ) ) ; ?>
			
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('#color_<?php echo $the_id ?>').wpColorPicker();
				});
			</script>
				
				<input id="color_<?php echo	$the_id ?>" type="hidden" name="<?php echo $name?>" class="">
			<?php	

			  if( is_admin() ) { 
			        // Add the color picker css file       
			        wp_enqueue_style( 'wp-color-picker' );          
			        // Include our custom jQuery file with WordPress Color Picker dependency
			        wp_enqueue_script( 'custom-script-handle', plugins_url( 'custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
			    }
		}
		
		
		/**
		 * 	Submit 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $id 
		 * @var string $title 
		 *
		 * @return <label name=..>
		 **/			
		static function submit( $name, $title, $attr= array() ){				

			return '<input type="submit" name="' . $name . '" value="'. $title .'" ' . self::attr( $attr ) . '>';

		}
		
		
		/**
		 * 	Label 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var string $id 
		 * @var string $title 
		 *
		 * @return <label name=..>
		 **/			
		static function label( $id, $title ){				
			
			return '<label for="' . $id . '">' . $title . '</label>';

		}

		/**
		 * 	Input atributes return html attr from array
		 *   
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @var array $attrs atributes in array( 'name' => 'value')
		 * @var array $filter atributes for remove array( 'name', 'name1')
		 *
		 * @return html attributs 
		 **/	
		static function attr( $attrs, $filter = array() ){
			
				$filter = array('type', 'id');
				$result = '';

				foreach ( $attrs as $key => $value) :
					//if ont in filetr var 
					if (!in_array($key, $filter)) :			
						$result .= $key. '="' .$value.'" ';	
					endif;	
				endforeach;

			return $result; 


		}
		
		
	}
	


?>