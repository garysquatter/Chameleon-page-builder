<?php
/**
 * @package The_Chameleom
 * @version 1.6
 */
/*
Plugin Name: The Chameleon Page Builder
Plugin URI: 
Description:
Author: Goran Petrovic
Version: 1.1
Author URI: 
*/


	namespace TheChameleonPageBuilder;



	/*
	$var = 'a:17:{s:19:"wp_inactive_widgets";a:7:{i:0;s:12:"categories-6";i:1;s:10:"nav_menu-5";i:2;s:26:"featured_content_widgets-3";i:3;s:26:"featured_content_widgets-4";i:4;s:30:"thechameleon_widget_elements-2";i:5;s:10:"calendar-2";i:6;s:12:"categories-4";}s:5:"upper";a:2:{i:0;s:12:"categories-7";i:1;s:37:"thechameleon_widget_social_networks-3";}s:6:"header";a:0:{}s:3:"top";a:1:{i:0;s:36:"thechameleon_advanced_recent_posts-7";}s:4:"page";a:7:{i:0;s:36:"thechameleon_advanced_recent_posts-5";i:1;s:17:"recent-comments-2";i:2;s:8:"search-2";i:3;s:14:"recent-posts-2";i:4;s:10:"archives-2";i:5;s:12:"categories-2";i:6;s:6:"meta-2";}s:8:"post-top";a:0:{}s:4:"post";a:0:{}s:11:"post-footer";a:0:{}s:6:"bottom";a:2:{i:0;s:39:"thechameleonrestaurant_gallery_widget-3";i:1;s:47:"thechameleonrestaurant_restaurant_menu_widget-2";}s:6:"footer";a:2:{i:0;s:10:"nav_menu-3";i:1;s:10:"nav_menu-4";}s:9:"copyright";a:0:{}s:6:"page-1";a:0:{}s:6:"page-2";a:0:{}s:6:"page-3";a:0:{}s:6:"page-4";a:0:{}s:8:"test-333";a:1:{i:0;s:10:"calendar-3";}s:13:"array_version";i:3;}';
		
		print_r( unserialize($var) );
	
	
		$var2 = 'a:3:{i:5;a:14:{s:5:"title";s:0:"";s:3:"tag";s:2:"-1";s:8:"category";s:2:"-1";s:7:"orderby";s:4:"date";s:5:"order";s:4:"DESC";s:14:"posts_per_page";s:1:"4";s:7:"columns";s:5:"col-1";s:15:"show_post_title";s:1:"1";s:12:"title_length";s:0:"";s:12:"meta_pattern";s:11:"By %author%";s:15:"show_post_media";s:2:"on";s:17:"show_post_excerpt";s:2:"on";s:6:"length";s:0:"";s:8:"template";s:6:"recent";}s:12:"_multiwidget";i:1;i:7;a:14:{s:5:"title";s:0:"";s:3:"tag";s:2:"-1";s:8:"category";s:2:"-1";s:7:"orderby";s:4:"date";s:5:"order";s:4:"DESC";s:14:"posts_per_page";s:1:"4";s:7:"columns";s:5:"col-3";s:15:"show_post_title";s:1:"1";s:12:"title_length";s:0:"";s:12:"meta_pattern";s:0:"";s:15:"show_post_media";s:2:"on";s:17:"show_post_excerpt";s:2:"on";s:6:"length";s:0:"";s:8:"template";s:8:"carousel";}}';
		print_r( unserialize($var2) );*/
	

	


	include_once('framework/classes/class-config.php');

	global $config;

	$config 			   = Config::getInstance();	
	$config->slug 		   = 'the_chameleon_page_builder_';
	$config->namespace 	   = 'TheChameleonPageBuilder';
	$config->DIR           = plugin_dir_path( __FILE__ );
	$config->URL  		   = plugin_dir_url( __FILE__ );
	$config->basename      = plugin_basename( dirname( __FILE__ ) );
	$config->FILE  		   = __FILE__;	

	$config->the_chameleon_page_builder_class = array('page_builder_light'=>'Light', 'page_builder_dark'=>'Dark');

	//include helpers
	foreach (glob( 	$config->DIR .'/framework/helpers/*', GLOB_NOSORT ) as $dir_path) :
		include_once( $dir_path );
	endforeach;

	//incude classes
	foreach (glob( 	$config->DIR .'/framework/classes/*', GLOB_NOSORT ) as $dir_path) :
		include_once( $dir_path );
	endforeach;

	//include parts
	foreach (glob( 	$config->DIR .'/parts/*', GLOB_ONLYDIR ) as $dir_path) :
		$dir = explode('/', $dir_path);	
		$name =  end($dir);
		include_once( $dir_path.'/'.$name.'.php' );
	endforeach;

	//include widgets
	foreach (glob( $config->DIR.'widgets/*', GLOB_ONLYDIR ) as $dir_path) :
		$dir = explode('/', $dir_path);	
		$name =  end($dir);
		include_once( $dir_path.'/'.$name.'.php' );
	endforeach;

	include_once('framework/class-bootstrap.php');

	global $TheChameleonPageBuilder;					
	$TheChameleonPageBuilder = new Bootstrap();

	
	require 'scripts/plugin-update-checker/plugin-update-checker.php';
	$className = \PucFactory::getLatestClassVersion('PucGitHubChecker');
	$myUpdateChecker = new $className(
	    'https://github.com/goran321/the-chameleon-page-builder/',
	    __FILE__,
	    'master'
	);
	$myUpdateChecker->setAccessToken('5a568aa699a8aec9bd380be2af6df85be8273c7c');

/*
	global 	$wp_registered_sidebars, $wp_registered_widgets, $wp_registered_widget_controls, $wp_registered_widget_updates, $sidebars_widgets;
	
	
	print_R($wp_registered_sidebars);
	print_R($sidebars_widgets);*/

	

?>