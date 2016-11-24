<?php


namespace TheChameleonPageBuilder;
	
	class Bootstrap{
		
		public $config;
	
		function __construct(){

			global $config;
			$this->config = Config::getInstance();	

			//set parts
			$parts = $this->set_parts();

			//Post Types
			$PostTypes = new Post_Types( $parts );
			
			//Meta Boxes 
			$MetaBoxes = new Meta_Boxes( $parts );
			
			//Term Meta 
			/*$TermMeta = new Term_Meta( $parts );*/
			
			//add style and scripts
			add_action( 'wp_enqueue_scripts', array(&$this, 'scripts_and_styles' ) );
			
			//admin scripts ans styles	
			add_action( 'admin_enqueue_scripts', array(&$this, 'admin_scripts_and_styles' ) );	
		
			//setting link in plugins list
			add_filter( 'plugin_action_links_the-chameleon-skin/the-chameleon-skin.php', array(&$this, 'add_action_links' ) );
			
			//load_textdomain
			add_action( 'plugins_loaded', array(&$this, 'load_textdomain')  );
			
			//register widgets
			add_action( 'widgets_init', array(&$this, 'register_widgets') );
			
			
			//replace theme skin 
			add_action( 'wp_enqueue_scripts', array(&$this, 'scripts_and_styles' ));
			
			//remove the chameleon page builder
			add_action( 'do_meta_boxes' , array($this , 'remove_the_chameleon_page_builder'), 10 );
			
			
			//register Sidebars 
			add_action('widgets_init', array(&$this,'register_page_builder_sidebars'), 2 );	 
			
			//filter content
			add_filter( 'the_content',  array( &$this, 'filter_content' ) ); 
			
			add_filter( 'page_template', array( &$this, 'wpa3396_page_template' ) );
			
			
			//register Sidebars 
			/*add_action('widgets_init', array(&$this,'register_sidebars'), 2 );*/	
			/*add_action('customize_preview_init', array(&$this,'test') );*/
			
			
		
			add_action('widgets_init', array(&$this,'register_sidebars') );
				
		
			/*add_action( 'customize_register', array(&$this, 'codeartist_customize_register' ) );*/
			
			
			add_action( 'customize_controls_enqueue_scripts',  array(&$this, 'custom_customize_enqueue' ) );
			
			add_action( 'customize_controls_init',  array(&$this, 'custom_customize_enqueue' ) );
			add_action( 'admin_enqueue_scripts',  array(&$this, 'custom_customize_enqueue' ) );
			
	
		
			//edit_post transfer_page_builder_data
			add_action( 'admin_init', array( &$this, 'transfer_page_builder_data' ));		
				
				
		}
	
		function transfer_page_builder_data(){
			
			if( strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php') ) :
			    //I'm editing a post, page or custom post type
				
				
				if(isset($_GET['post'])) :
					
					//get post 
					$post_id = $_GET['post'];
					
					//get chameleon themes meta
					$the_chameleon_data = get_post_meta($post_id, 'the_chameleon_meta', true);

				/*	print_R($tMeta);*/
					
					$tranfer_check = get_post_meta($post_id, 'the_chameleon_page_builder_transfer_data', true); 
						
					if ( !empty( $the_chameleon_data ) and $tranfer_check!="yes") :
						
					/*
						foreach ( $tMeta as $key1 => $value ) :							
												if ( is_array( $value ) ) :	
													$the_chameleon_data[$value['key']] =  $value['value'];
												endif;
											endforeach;
										
										*/
					
						/*print_R($the_chameleon_data);*/
					
						$new_data = array(
		
						    'switch' => array(
							
						            'header' 	=> !empty( $the_chameleon_data['header_sidebar'] ) 	  ? 'on' : 'off',
						            'top' 		=> !empty( $the_chameleon_data['top_sidebar'] ) 	  ? 'on' : 'off', 
						            'section1' 	=> !empty( $the_chameleon_data['section_1_sidebar'] ) ? 'on' : 'off', 
						            'section2' 	=> !empty( $the_chameleon_data['section_2_sidebar'] ) ? 'on' : 'off',  
						            'section3' 	=> !empty( $the_chameleon_data['section_3_sidebar'] ) ? 'on' : 'off',  
						            'section4' 	=> !empty( $the_chameleon_data['section_4_sidebar'] ) ? 'on' : 'off', 
						            'section5' 	=> !empty( $the_chameleon_data['section_5_sidebar'] ) ? 'on' : 'off', 
						            'section6' 	=> !empty( $the_chameleon_data['section_6_sidebar'] ) ? 'on' : 'off', 
						            'section7' 	=> !empty( $the_chameleon_data['section_7_sidebar'] ) ? 'on' : 'off', 

						        ),
							
						    'sidebars' => array(
						            'header' 	=> $the_chameleon_data['header_sidebar'],
						            'top' 		=> $the_chameleon_data['top_sidebar'],
						            'section1' 	=> $the_chameleon_data['section_1_sidebar'],
						            'section2' 	=> $the_chameleon_data['section_2_sidebar'], 
						            'section3' 	=> $the_chameleon_data['section_3_sidebar'], 
						            'section4' 	=> $the_chameleon_data['section_4_sidebar'], 
						            'section5' 	=> $the_chameleon_data['section_5_sidebar'],
						            'section6' 	=> $the_chameleon_data['section_6_sidebar'], 
						            'section7' 	=> $the_chameleon_data['section_7_sidebar'], 
						        ),
								
						    'wrap' => array(
							
						            'header' 	=> $the_chameleon_data['header_wrap'],
						            'top' 		=> $the_chameleon_data['top_wrap'],
						            'section1' 	=> $the_chameleon_data['section_1_wrap'],
						            'section2' 	=> $the_chameleon_data['section_2_wrap'], 
						            'section3' 	=> $the_chameleon_data['section_3_wrap'], 
						            'section4' 	=> $the_chameleon_data['section_4_wrap'], 
						            'section5' 	=> $the_chameleon_data['section_5_wrap'],
						            'section6' 	=> $the_chameleon_data['section_6_wrap'], 
						            'section7' 	=> $the_chameleon_data['section_7_wrap'], 
						        ),

						    'col' => array(
						            'header' 	=> $the_chameleon_data['header_col'],
						            'top' 		=> $the_chameleon_data['top_col'],
						            'section1' 	=> $the_chameleon_data['section_1_col'],
						            'section2' 	=> $the_chameleon_data['section_2_col'], 
						            'section3' 	=> $the_chameleon_data['section_3_col'], 
						            'section4' 	=> $the_chameleon_data['section_4_col'], 
						            'section5' 	=> $the_chameleon_data['section_5_col'],
						            'section6' 	=> $the_chameleon_data['section_6_col'], 
						            'section7' 	=> $the_chameleon_data['section_7_col'], 
						        ),

						    'animate' => array(
						            'header' 	=> $the_chameleon_data['header_animate'],
						            'top' 		=> $the_chameleon_data['top_animate'],
						            'section1' 	=> $the_chameleon_data['section_1_animate'],
						            'section2' 	=> $the_chameleon_data['section_2_animate'], 
						            'section3' 	=> $the_chameleon_data['section_3_animate'], 
						            'section4' 	=> $the_chameleon_data['section_4_animate'], 
						            'section5' 	=> $the_chameleon_data['section_5_animate'],
						            'section6' 	=> $the_chameleon_data['section_6_animate'], 
						            'section7' 	=> $the_chameleon_data['section_7_animate'], 
						        ),

						    'animate_duration' => array(
					           	 	'header' 	=> $the_chameleon_data['header_duration'],
						            'top' 		=> $the_chameleon_data['top_duration'],
						            'section1' 	=> $the_chameleon_data['section_1_duration'],
						            'section2' 	=> $the_chameleon_data['section_2_duration'], 
						            'section3' 	=> $the_chameleon_data['section_3_duration'], 
						            'section4' 	=> $the_chameleon_data['section_4_duration'], 
						            'section5' 	=> $the_chameleon_data['section_5_duration'],
						            'section6' 	=> $the_chameleon_data['section_6_duration'], 
						            'section7' 	=> $the_chameleon_data['section_7_duration'], 
						        ),

						    'animate_delay' => array(
					           	 	'header' 	=> $the_chameleon_data['header_delay'],
						            'top' 		=> $the_chameleon_data['top_delay'],
						            'section1' 	=> $the_chameleon_data['section_1_delay'],
						            'section2' 	=> $the_chameleon_data['section_2_delay'], 
						            'section3' 	=> $the_chameleon_data['section_3_delay'], 
						            'section4' 	=> $the_chameleon_data['section_4_delay'], 
						            'section5' 	=> $the_chameleon_data['section_5_delay'],
						            'section6' 	=> $the_chameleon_data['section_6_delay'], 
						            'section7' 	=> $the_chameleon_data['section_7_delay'], 
						        ),

						    'class' => array(
					           	 	'header' 	=> isset( $the_chameleon_data['header_custom_class'] ) ? $the_chameleon_data['header_custom_class'] : "",
						            'top' 		=> isset( $the_chameleon_data['top_custom_class'] )    ? $the_chameleon_data['top_custom_class']    : "",
						            'section1' 	=> $the_chameleon_data['section_1_custom_class'],
						            'section2' 	=> $the_chameleon_data['section_2_custom_class'], 
						            'section3' 	=> $the_chameleon_data['section_3_custom_class'], 
						            'section4' 	=> $the_chameleon_data['section_4_custom_class'], 
						            'section5' 	=> $the_chameleon_data['section_5_custom_class'],
						            'section6' 	=> $the_chameleon_data['section_6_custom_class'], 
						            'section7' 	=> $the_chameleon_data['section_7_custom_class'], 
						        ),

						    'the_chameleon_class' => array(
							
					           	 	'header' 	=> isset( $the_chameleon_data['header_class'] ) ? $the_chameleon_data['header_class'] : "",
						            'top' 		=> isset( $the_chameleon_data['top_class'] )    ? $the_chameleon_data['top_class']    : "",
						            'section1' 	=> $the_chameleon_data['section_1_class'],
						            'section2' 	=> $the_chameleon_data['section_2_class'], 
						            'section3' 	=> $the_chameleon_data['section_3_class'], 
						            'section4' 	=> $the_chameleon_data['section_4_class'], 
						            'section5' 	=> $the_chameleon_data['section_5_class'],
						            'section6' 	=> $the_chameleon_data['section_6_class'], 
						            'section7' 	=> $the_chameleon_data['section_7_class'], 
						        )

						);
					
					
						/*print_R($new_data);*/
		
						update_post_meta($post_id, 'the_chameleon_page_builder_meta', $new_data );
						
						update_post_meta($post_id, 'the_chameleon_page_builder_transfer_data', 'yes');
						
					endif;	
					

				endif;
				
				
			endif;
			
			
		/*
			echo "ASDsa";
					$tMeta = get_post_meta($post_id, 'the_chameleon_meta', true);
		
					print_r($tMeta );
		
					$pMeta = get_post_meta($post_id, 'the_chameleon_page_builder_meta', true);
		
					print_r($pMeta );*/
		
		}
		
		
		
		/**
		 * Enqueue script for custom customize control.
		 */
		function custom_customize_enqueue() {
			wp_enqueue_script( 'custom-customize', $this->config->URL . 'js/custom.customize.js', array( 'jquery' ));
		}
		
		
		
	/*
	
			function codeartist_customize_register($wp_customize) {
				$wp_customize->add_panel( 'panel_for_widgets', array(
				    'priority'       => 70,
				    'title'          => __('Panel for widgets', 'codeartist'),
				    'capability'     => 'edit_theme_options',
				));
				
				$wp_customize->get_section( '122-1' )->panel = 'panel_for_widgets';
			}
			*/
	
		
		
		
		function test(){
		/*
			echo "ASd";*/
			print_R($_GET);
		
			$current_url = $_GET['url'];
			$current_id = url_to_postid( $current_url );
			global $_data ;
			$_data = array('post_id'=>$current_id);
			
			add_action('widgets_init', array(&$this,'register_sidebars'), 2 );	
			
		}
		
		/**
		 * 	Register sidebars
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function register_sidebars(){

		
			
			/*if(is_customize_preview()) :*/
			$args = array(
				'post_type'  => 'page',
				/*
				'meta_key'   => 'age',
								'orderby'    => 'meta_value_num',
								'order'      => 'ASC',*/
				
				'meta_query' => array(
					array(
						'key'     => 'the_chameleon_page_builder_meta',
						/*
						'value'   => array( 3, 4 ),
												'compare' => 'IN',*/
						
					),
				),
			);
			$posts = get_posts( $args );
			
			/*print_R(	$posts);*/
			
			if ( !empty( $posts ) ) :
				
			foreach ($posts as $key => $value) :
				
 			   $sidebars = array(
 				   $value->ID.'-1' => "Section 1",
 			       $value->ID.'-2' => "Section 2",
				   $value->ID.'-3' => "Section 3",
 			   );
			   # code...
			endforeach;
		
			   
				foreach (  $sidebars as $key => $value ) :
					if ( !empty( $key ) ) :
						register_sidebar(
								array(
									'name'          => $value,
									'id'			=> $key,
									'description'   => ' | http://google.com  ',
									'class'			=> 'the_chameleon',
									'before_widget' => '<section id="%1$s" class="widget  %2$s">', //hidden
									'after_widget'  => '</section></section><!-- end widget-->',
									'before_title'  => '<header class="widget-header"><h4>',
									'after_title'   => '</h4></header><section class="widget-content">' )
								);
					endif;
				endforeach;
				endif;
			/*endif;*/
			
		}
		
		
		
		
		function wpa3396_page_template( $page_template ){
		    if ( is_singular('page') ) {
					$config = Config::getInstance(); 
		        $page_template = $config->DIR.'parts/Page_Builder/view/page-builder.php';
		    }
		    return $page_template;
		}

		 function filter_content( $content ) { 
		    if ( is_singular('page')) {
		      
				$config = Config::getInstance(); 
				
				ob_start();
					/* PERFORM COMLEX QUERY, ECHO RESULTS, ETC. */
				include_once($config->DIR.'parts/Page_Builder/view/page-builder.php');
				
				$content = ob_get_contents();
			    ob_end_clean();
				
				
				
		   
				
		
			}

		    return $content;
		}



		//remove_the_chameleon_page_builder
		function remove_the_chameleon_page_builder() {
			remove_meta_box( 'page_builder_main' , 'page' , 'normal' ); 
		}
		



		/**
		 * 	Register sidebars
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function register_page_builder_sidebars(){
			
			/*if( is_customize_preview()) :*/
				
			
 		   $this->sidebars = array('test-333'=>'test 3333');
		   
			foreach ( $this->sidebars as $key => $value ) :
				if ( !empty( $key ) ) :
					register_sidebar(
							array(
								'name'          => $key,
								'id'			=> sanitize_title($key),
							/*
								'before_widget' => '<section id="%1$s" class="widget hidden %2$s">',
															'after_widget'  => '</section></section><!-- end widget-->',
															'before_title'  => '<header class="widget-header"><h4>',
															'after_title'   => '</h4></header><section class="widget-content">' )*/
							)
							);
				endif;
			endforeach;
		
		/*endif;*/

		}
		

	
	   	/**
		 * 	Set skripts and styles
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
	    function scripts_and_styles(){
  

	    	if ( !is_admin() ) :	

			endif;
		
	    }
		
		
		/**
		 * Load plugin textdomain.
		 *
		 * @since 1.0.0
		 */
		function load_textdomain() {

		  load_plugin_textdomain( 'the-chameleon-expansion', false,  $this->config->DIR .'/i18n' ); 
		}
	
	
		/**
		 * 	Setting link in plugins list
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/ 
		function add_action_links ( $links ) {
		 	$plugin_links = 
				array(
		 		'<a href="' . admin_url( 'options-general.php?page=the_skin_setting' ) . '">'. __('Settings','the-chameleon-expansion') .'</a>',
		 		);
			return array_merge(  $plugin_links, $links );
		}
		
		
		

		/**
		 * 	Admin inlude style and scripts
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function admin_scripts_and_styles(){
				
		 	$config = Config::getInstance();
			wp_enqueue_style( 'the-chameleon-page-builder-admin', $config->URL .'css/style.css' );
		}
	
	

		
		/**
		 * 	Set all parts in to $this->part name  PARTS
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		 private function set_parts(){
			
			$parts = null;
			//register all parts like part name == class name	
			foreach (glob( 	$this->config->DIR .'/parts/*', GLOB_ONLYDIR ) as $paths) :

				$dir = explode('/', $paths);	
				$part =  end($dir);

				$this->parts[] = $part;

				//namespace class name, replace the ' fix 
				$class_name = str_replace("'",'',$this->config->namespace."\'".$part);
				
				$this->{$part}  = new $class_name($this);	

				$parts[$part]  	=  $this->{$part};	

			endforeach;
			
			
			return 	$parts;
			
		}
			
		
		/**
		 * 	Set all parts in to $this->part name 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		 function register_widgets(){

			//register all parts like part name == class name	
			foreach (glob( $this->config->DIR.'widgets/*', GLOB_ONLYDIR ) as $paths) :

				$dir = explode('/', $paths);	
				$widget =  end($dir);

				$this->widegt[] = $widget;

				//class name
				$widget_class_name = $this->config->namespace.'_'.$widget.'_Widget';

					if ( !is_blog_installed() )
							return;

					register_widget( $widget_class_name ) ;	

			endforeach;			

		}

		


	}
	
?>