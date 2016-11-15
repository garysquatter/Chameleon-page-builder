<?php



namespace TheChameleonPageBuilder;


    class Settings{
	
        /******
         *** Construct the plugin object
         ***/
        public function __construct(){
	
            // register actions
            add_action('admin_init', array(&$this, 'admin_init'));
            add_action('admin_menu', array(&$this, 'add_menu'));
        } // END public function __construct
    
        /******
         *** hook into WP's admin_init action hook
         ***/
        public function admin_init(){
	
	
         // register your plugin's settings
		$options = 
			array(
				array(
					'title'	=> 'Skin Slug',
					'desc'	=> 'Add skin slug from lab.hameleonthemes.net',
					'filed'	=> 'the_chameleon_lab_skin_slug',	
					'type'	=> 'text',
					
					),
				
	
			);


            // add your settings section
            add_settings_section(
                'the_chamelon_skin_plugin_template-section', 
                '', 
                array(&$this, 'settings_section_the_chamelon_skin_plugin_template'), 
                'the_chamelon_skin_plugin_template'
            );

 
			foreach ($options as $key => $value) :
				
				
				//register fileds
				register_setting('the_chamelon_skin_plugin_template-group',  $value['filed']); 
				
				 // add your setting's fields   
				add_settings_field(
	                'the_chamelon_skin_plugin_template-'.$value['filed'], 
	                $value['title'], 
	                array(&$this, 'settings_field_input_'.$value['type']), 
	                'the_chamelon_skin_plugin_template', 
	                'the_chamelon_skin_plugin_template-section',
	                array(
	                    'field' 	=> $value['filed'],
	 					'value' 	=> !empty( $value['value'] ) ? $value['value'] : NULL, 
						'choices'	=> !empty( $value['choices'] ) ? $value['choices'] : array(),
						'desc'		=> !empty( $value['desc'] ) ? $value['desc'] : NULL,
	                )
	            );
			
			
			endforeach;

            // Possibly do additional admin_init tasks
        } // END public static function activate
    
        public function settings_section_the_chamelon_skin_plugin_template()
        {
   
        }
    

		
        // This function provides text inputs for settings fields
        public function settings_field_input_select($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = !empty( get_option($field) ) ? get_option($field) : $args['value'];
            // echo a proper input type="text"
			
			$choices = $args['choices'];
			
			/*choices*/
			echo Form::select(  $field ,  $value ,  $choices );
			echo ($args['desc'] ) ? '<br /><em>'.$args['desc'].'</em>' : '';
        } // END p


		
        // This function provides text inputs for settings fields
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
			echo ($args['desc'] ) ? '<br /><em>'.$args['desc'].'</em>' : '';
        } // END public function settings_field_input_text($args)
    

		//This function preovides check inputs for settings fileds
		function settings_field_input_checkbox($args) 
		{		
		  	// Get the field name from the $args array
          	$field = $args['field'];
			$desc = !empty( $args['desc'] ) ? $args['desc'] : NULL;
			$desc2 = !empty( $args['desc2'] ) ? $args['desc2'] : NULL;
           	// Get the value of this setting
           	$value = get_option($field);
	 	  	echo '<label style="display:block;"><input name="' . $field . '" id="' . $field . '" type="checkbox"  value="1" class="check_class" class="code" ' . checked( 1, $value , false ) . ' /> '.$desc.' <small>'.$desc2.'</small></label>';	
			
		
			
	 	}
	 

		//This function preovides check inputs for settings fileds
		function settings_field_input_radio($args) 
		{		
		  	// Get the field name from the $args array
          	$field = $args['field'];
			$desc = !empty( $args['desc'] ) ? $args['desc'] : NULL;
			$desc2 = !empty( $args['desc2'] ) ? $args['desc2'] : NULL;
           	// Get the value of this setting
           	$value = get_option('customize_style_active_options');
	 	  	echo '<label style="height:10px;"><input name="input_radio" id="' . $field . '" type="radio" value="' .$field . '" class="code" ' . checked( $field, $value , false ) . ' /> '.$desc.'<small>'.$desc2.'</small></label>';		
	 	}

        //add a menu  
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
			call_user_func('add_options_page',  
				'The Skin', 
                'The Skin', 
                'manage_options', 
                'the_skin_setting', 
                array(&$this, 'plugin_settings_page')
			);

        } // END public function add_menu()

       	// Menu Callback
        public function plugin_settings_page()
        {
            if(!current_user_can('manage_options'))
            {
                wp_die(__('You do not have sufficient permissions to access this page.'));
            }

            // Render the settings template
			 $this->view();


        } // END public function plugin_settings_page()


		//view
		public function view(){ ?>
			
			<div class="wrap">
			    <h2>The Chameleon Skin</h2>
			    <form method="post" action="options.php"> 
			        <?php @settings_fields('the_chamelon_skin_plugin_template-group'); ?>
			        <?php @do_settings_fields('the_chamelon_skin_plugin_template-group'); ?>

			        <?php do_settings_sections('the_chamelon_skin_plugin_template'); ?>

			        <?php @submit_button(); ?>
			    </form>
			</div>
		<?php }


    } // END class Settings



/*$TransworldSetting = new Settings();*/



?>