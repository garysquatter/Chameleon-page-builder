<?php
namespace TheChameleonPageBuilder{


	class Page_Builder extends Part{
		

		public $view 	 = 'page_builder';
		public $template = 'fullwidth';
		public $path 	 = '/parts/Page_Builder/';		
		public $config ;

		function __construct( ){

			$this->config = Config::getInstance();
			
		}

		/**
		 * 	Post meta options 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function meta_boxes(){
					
			global $data;
			return $this->post_meta = array(


										array(	
											'post_types' => array('page'),
											'title'		 => __('Widgets Page Builder - The Chameleon','the-chameleon'),
											'id'		 => 'the_chameleon_plugin_page_builder_main',
											'desc'		 => __('Use this Page builder to build layout for your page using the widgets. Create sidebars and select them in one of twenty sections and choice number of columns, aminate effect, dealy and duration for that section. Then go on Appearance >> Customize and add widgets in the sidebars.','the-chameleon'),
											'fields' 	 => array(

													//header
													array(
														'type'	  => 'the_chameleon_page_builder',
														'name'	  => 'the_chameleon_page_builder',
														'title'	  => '',
														'desc'	  => __('Choice wrap for Header section.','the-chameleon'),
														'default' => '',
														'choices' => array(), // $this->config->sidebars,
														'attr'	  => array('class'=>'', 'style'=>'')
														),
														
														
													),	
											),
							
									
										array(	
											'post_types' => array('page'),
											'title'		 => __('Custom CSS - The Chameleon','the-chameleon'),
											'id'		 => 'page_builder_10',
											'desc'		 => __('Use this option to enter custom css for this page.','the-chameleon'),
											'fields' 	 => array(

												//bottom
												array(
													'type'	  => 'textarea',
													'name'	  => 'custom_css',
													'title'	  => '',
													'desc'	  => __('Enter your custom css just for this page.','the-chameleon'),
													'default' => '',
													'attr'	  => array('class'=>'', 'style'=>'width:100%; height:250px;')
													),
											
									
											  )//fileds

						 				),//box2
								);

		}

		
}		
	
}
?>