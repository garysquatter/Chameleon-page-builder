<?php 

get_header();

//http://themehybrid.com/board/topics/customizer-current-preview-url
global $TheChameleonPageBuilderMeta;  

$main_wrap  = 'fullwidth'; 

$meta = get_post_meta(get_the_ID(), 'the_chameleon_page_builder_meta', true);

/*print_R($meta );*/
/*
[bg_color] => Array
        (
            [header] => #81d742
            [top] => 
            [section1] => #dd3333
            [section2] => 
            [section3] => 
            [section4] => 
            [section5] => 
            [section6] => 
            [section7] => 
        )

    [bg_image] => Array
        (
            [header] => http://localhost/chameleon/wp-content/uploads/2016/11/design-1.jpg
            [top] => 
            [section1] => 
            [section2] => 
            [section3] => 
            [section4] => 
            [section5] => 
            [section6] => 
            [section7] => 
        )

    [bg_type] => Array
        (
            [header] => tile
            [top] => tile
            [section1] => tile
            [section2] => tile
            [section3] => tile
            [section4] => tile
            [section5] => tile
            [section6] => tile
            [section7] => tile
        )

    [color] => Array
        (
            [header] => #1e73be
            [top] => 
            [section1] => #1e73be
            [section2] => 
            [section3] => 
            [section4] => 
            [section5] => 
            [section6] => 
            [section7] => 
        )

    [color_link] => Array
        (
            [header] => #8224e3
            [top] => 
            [section1] => #8224e3
            [section2] => 
            [section3] => 
            [section4] => 
            [section5] => 
            [section6] => 
            [section7] => 
        )

    [border_color] => Array
        (
            [header] => #000000
            [top] => 
            [section1] => #dd9933
            [section2] => 
            [section3] => 
            [section4] => 
            [section5] => 
            [section6] => 
            [section7] => 
        )*/


?>

 <style type="text/css" media="screen">
 <?php 
/*  print_r(  $meta );*/
 
  $css_options = array('bg_image'=>'background-image', 'bg_color'=>'background-color', 'bg_type' );
  
 foreach ($css_options as $css_key => $css_option) {
 
	 foreach ($meta[$css_key] as $key => $m) {
		 
		 echo 'key'.$css_key. '==='.$key.'-';
		  echo 'v'.$m.'<br />';
		/*
		 echo $key;
			 print_R($m);*/
	
	 	 /*
	 	 $bg_image 		= !empty( $m['bg_image'] ) 		? $m['bg_image'] : '';
	 	 		 $bg_color 		= !empty( $m['bg_color'] ) 		? $m['bg_color'] : '';
	 	 		 $bg_type		= !empty( $m['bg_type']) 		? $m['bg_type']  : '';
	 	 	 
	 	 		 $p_t 			= !empty( $m[$key]['padding_top'] ) 	? $m[$key]['padding_top'] 	: '';
	 	 		 $p_r 			= !empty( $m[$key]['padding_right'] ) 	? $m[$key]['padding_right'] 	: '';
	 	 		 $p_b 			= !empty( $m[$key]['padding_bottom'] )	? $m[$key]['padding_bottom'] 	: '';
	 	 		 $p_l 			= !empty( $m[$key]['padding_left'] ) 	? $m[$key]['padding_left'] 	: '';
	 	 	 
	 	 		 $color 	 	= !empty( $m[$key]['color'] ) 		? $m[$key]['color'] 		: '';
	 	 		 $color_link 	= !empty( $m[$key]['color_link'] ) 	? $m[$key]['color_link'] 	: '';
	 	 	 
	 	 		 $border 		= !empty( $m[$key]['border'] ) 			? $m[$key]['border'] 		 : '';
	 	 		 $border_color  = !empty( $m[$key]['border_color'] ) 	? $m[$key]['border_color'] : '';
	 	 	 
	 	 		 echo	  $key. ' ' .$bg_color.'<br />' ;*/
	 	 
		/* $background = */
	 
		/* echo '#page-builder-'.$key.'{background:'.$bg_color.';}';*/
	
		
	
	 }  
	 
 } ;
 
 

 
 ?>

 
 </style>
	
<!-- Start page -->
<section id="page-<?php the_ID(); ?>" <?php post_class('the_chameleon_page_builder'); ?>>
<?php if ( $main_wrap  == 'stretch' ) : ?>
	<div id="page-<?php the_ID(); ?>-container" class="container page-container page-container-<?php the_ID(); ?>">
<?php endif;?>
		<section  id="page-content-<?php the_ID();?>" class="col100 page-builder-<?php the_ID();?> page-content-<?php the_ID();?>">
		 <?php for ($i=1; $i <= 7 ; $i++) : 
			 
			 $meta['switch']['section'.$i] = !empty($meta['switch']['section'.$i]) ? $meta['switch']['section'.$i] :"off"; 
			 
			 $wrap          = !empty( $meta['wrap']['section'.$i] ) 			? $meta['wrap']['section'.$i] : 'normal'; 
			
		 	 $bg_image 		= !empty( $meta['bg_image']['section'.$i] ) 		? $meta['bg_image']['section'.$i] : '';
 	 		 $bg_color 		= !empty( $meta['bg_color']['section'.$i] ) 		? $meta['bg_color']['section'.$i] : '';
 	 		 $bg_type		= !empty( $meta['bg_type']['section'.$i]) 			? $meta['bg_type']['section'.$i]  : '';
 	 
 	 		 $p_t 			= !empty( $meta['padding_top']['section'.$i] ) 		? $meta['padding_top']['section'.$i] 		: '';
 	 		 $p_r 			= !empty( $meta['padding_right']['section'.$i] ) 	? $meta['padding_right']['section'.$i] 	: '';
 	 		 $p_b 			= !empty( $meta['padding_bottom']['section'.$i] )	? $meta['padding_bottom']['section'.$i] 	: '';
 	 		 $p_l 			= !empty( $meta['padding_left']['section'.$i] ) 	? $meta['padding_left']['section'.$i] 	: '';
 	 
 	 		 $color 	 	= !empty( $meta['color']['section'.$i] ) 			? $meta['color']['section'.$i] 		: '';
 	 		 $color_link 	= !empty( $meta['color_link']['section'.$i] ) 		? $meta['color_link']['section'.$i] 	: '';
 	 
 	 		 $border 		= !empty( $meta['border']['section'.$i] ) 			? $meta['border']['section'.$i] 		: '';
 	 		 $border_color  = !empty( $meta['border_color']['section'.$i] ) 	? $meta['border_color']['section'.$i] : '';
			  
			 echo  '<style type="text/css" media="screen">';
			 
				 echo '#page-builder-section'.$i.'{';
				 	echo !empty($bg_color) ? 'background-color:'.$bg_color.';': "";
					echo !empty($bg_image) ? 'background-image: url('.$bg_image.');': "";
					
					echo !empty($p_t) ? 'padding-top:'.$p_t.'px;': "";
					echo !empty($p_r) ? 'padding-right:'.$p_r.'px;': "";
					echo !empty($p_b) ? 'padding-bottom:'.$p_b.'px;': "";
					echo !empty($p_l) ? 'padding-left:'.$p_l.'px;': "";
					
					
					if( $wrap  =="normal") :
						echo ( !empty( $border ) and !empty( $border_color ) ) ? 'border:'.$border.'px solid '. $border_color.';': "";
					else:
						echo ( !empty( $border ) and !empty( $border_color ) ) ? 'border-top:'.$border.'px solid '. $border_color.'; border-bottom:'.$border.'px solid '. $border_color.';' : "";
					endif;
					
				  echo "}";
				  
				  echo '#page-builder-section'.$i.',#page-builder-section'.$i.' p {';
					  
				  	echo !empty($color) ? 'color:'.$color.';': "";
					 
				  echo '}';
					
				  echo '#page-builder-section'.$i.' a{';
					  
				  	echo !empty($color_link) ? 'color:'.$color_link.';': "";
					 
				  echo '}';
			 echo '</style>';
			 ?> 	
			 		
			<?php echo '<!-- Page Builde Section '.$i.'-->'; ?>
				<?php if (  $meta['switch']['section'.$i] == 'on' ) : ?>						
                   	<?php if (  $meta['wrap']['section'.$i]  == 'normal' ) : ?>
						<div id="page-builder-section-<?php echo $i ?>-<?php the_ID(); ?>-container" class="container page-container page-container-<?php the_ID(); ?>">
					<?php endif;?>  						                      
						<section id="page-builder-section<?php echo $i ?>" class="col100 page-builder page-builder-section-<?php echo $i ?> <?php echo $meta['class']['section'.$i].' '.$meta['col']['section'.$i] ?>">
							<?php if (  $meta['wrap']['section'.$i]   == 'stretch' ) : ?>
								<div id="page-builder-section-<?php echo $i ?>-<?php the_ID(); ?>-container" class="container page-container page-container-<?php the_ID(); ?>">
							<?php endif;?>  	
						     <!-- GET SIDEBAR -->        
							 <?php dynamic_sidebar( get_the_ID().'-'.$i ); ?>
									                     
                             <?php echo ( $meta['wrap']['section'.$i]  == 'stretch' ) ? '</div>' : NULL; ?>	                    
						</section>  
					  <?php echo (  $meta['wrap']['section'.$i] == 'normal' ) ? '</div>' : NULL; ?>	                                     
				  <?php endif;  ?>	 
			  	<?php echo '<!-- End Page Builde Section '.$i.'-->'; ?>        
		   <?php endfor; ?>  		             
		</section>			
</section>
 <?php get_footer() ?>