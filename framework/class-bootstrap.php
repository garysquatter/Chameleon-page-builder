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