<?php 

get_header();

//http://themehybrid.com/board/topics/customizer-current-preview-url
global $TheChameleonMeta;  

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
 <?php foreach ($meta['bg_color'] as $key => $bg_color) {
 	
	 echo '#page-builder-'.$key.'{background:'.$bg_color.';}';
	
	
	
 } ?>
 /*.the_chameleon_page_builder_wrap{float:left;}*/
/*
 * < .the_chameleon_page_builder_wrap {
	 width:100% !important;
	 border:1px solid green !important;
 }*/

 
 </style>
	
<!-- Start page -->
<section id="page-<?php the_ID(); ?>" <?php post_class('the_chameleon_page_builder'); ?>>
		

	<?php if ( $main_wrap  == 'stretch' ) : ?>
		<div id="page-<?php the_ID(); ?>-container" class="container page-container page-container-<?php the_ID(); ?>">
	<?php endif;?>


		<section  id="page-content-<?php the_ID();?>" class="col100 page-builder-<?php the_ID();?> page-content-<?php the_ID();?>">

				 <?php for ($i=1; $i <= 7 ; $i++) : ?> 
					
       				<?php echo '<!-- Page Builde Section '.$i.'-->'; ?>

						<?php if (  $meta['switch']['section'.$i] == 'on' ) : ?>
							
	                       	<?php if (  $meta['wrap']['section'.$i]  == 'normal' ) : ?>
								<div id="page-builder-section-<?php echo $i ?>-<?php the_ID(); ?>-container" class="container page-container page-container-<?php the_ID(); ?>">
							<?php endif;?>  
							                      
								<section id="page-builder-section<?php echo $i ?>" class="col100 page-builder page-builder-section-<?php echo $i ?> <?php echo $meta['class']['section'.$i].' '.$meta['col']['section'.$i] ?>" style="border:1px solid red;">
				                 
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