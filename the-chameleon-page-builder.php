<?php
/*
Plugin Name: The Chameleon Page Builder
Plugin URI: https://github.com/goran321/the-chameleon-page-builder/
Description: Simple page builder base on widgets editable from customize
Author: Goran Petrovic
Version: 1.2
Author URI: https://chameleonthemes.net
*/


	namespace TheChameleonPageBuilder;


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
	$myUpdateChecker->setAccessToken('4d27d090f094a8104b68ca97c87d37455c7d52ca');


?>