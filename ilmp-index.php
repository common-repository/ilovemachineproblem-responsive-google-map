<?php 
	/*
		Plugin Name: ILoveMachineProblem Responsive Google Map
		Description: The ILoveMachineProblem Responsive Google Map is used to embed responsive google map on your site.
		Version: 2.0.2
		Author: Paul Justine B. de Honor
		Author URI
		License: MIT
	*/

	if (!defined('WP_PLUGIN_DIR')) {
	    die('This WordPress plugin is not supported by your system.');
	}

	define('ILMP_DIR', plugins_url( '/ilmp-rgm' ));
	
	register_activation_hook( __FILE__, '_ilmp_rgm_activate');
	register_deactivation_hook( __FILE__, '_ilmp_rgm_deactivate');

	add_action('wp_enqueue_scripts', '_ilmp_register_scripts');
	add_action('admin_enqueue_scripts', '_ilmp_register_scripts');
	add_action('admin_menu', '_ilmp_rgm_menu');

	function _ilmp_register_options(){
		add_option('ilmp_address', '', '', yes ); // Address of the map.
		add_option('ilmp_title', 'ILMP RGM', '', yes ); // Title of the map.
		add_option('ilmp_addinfo', '', '', yes ); // Additional information.

		add_option('ilmp_width', '100%', '', yes ); // Width of the map.
		add_option('ilmp_height', '300px', '', yes ); // Height of the map.

		add_option('ilmp_lat', 14.604681, '', yes ); // Latitude location of the map.
		add_option('ilmp_lng', 120.984165, '', yes ); // Longitude location of the map.
		add_option('ilmp_zoom', 8, '', yes ); // Zoom number.
		add_option('ilmp_ptc', 3000, '', yes ); // Pan to center after 3 seconds.
		add_option('ilmp_ptcs', 1, '', yes ); // Pan to center status. True or false.

		add_option('ilmp_infow', '100%', '', yes ); // Width of the InfoWindow.		
		add_option('ilmp_infoh', '200px', '', yes ); // Height of the InfoWindow.		
		
		add_option('ilmp_map_link', '', '', yes ); // Link to google map.
		add_option('ilmp_maptype', 'roadmap', '', yes ); // Map type.

		add_option('ilmp_resp', '767px', '', yes ); // Width to activate responsive.
	}

	function _ilmp_register_scripts(){
		wp_register_script( 'ilmp-rgm-googleapi', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=en');
		wp_enqueue_script('ilmp-rgm-googleapi');
	}

	function _ilmp_rgm_activate(){
		_ilmp_register_options();
	}

	function _ilmp_rgm_deactivate(){
		delete_option('ilmp_address');
		delete_option('ilmp_title');
		delete_option('ilmp_addinfo');
		delete_option('ilmp_width');
		delete_option('ilmp_height');
		delete_option('ilmp_lat');
		delete_option('ilmp_lng');
		delete_option('ilmp_zoom');
		delete_option('ilmp_ptc');
		delete_option('ilmp_ptcs');
		delete_option('ilmp_infow');
		delete_option('ilmp_infoh');
		delete_option('ilmp_map_link');
		delete_option('ilmp_maptype');
		delete_option('ilmp_resp');
	}
	
	function _ilmp_rgm_menu(){
		add_menu_page(
		  	'ILMP RGM',
		  	'ILMP RGM',
		  	'manage_options',
		  	'ilmp-rgm',
		  	'_ilmp_rgm_menu_page',
		  	ILMP_DIR. '/images/ilmp-icon.png',
		  	81
		);
	}

	function _ilmp_rgm_menu_page(){
		include_once('includes/ilmp-rgm-admin-page.php');
	}	

	function _ilmp_rgm() {
		return '<div class="ilmp-map-wrapper">';
		return '<div id="ilmp-map-canvas"></div>';
		return '<a href="' . get_option('ilmp_map_link') . '" class="ilmp-map-link" target="_blank">View larger map</a>';
		return '</div>';
		require_once('includes/ilmp-rgm-style.php');
		require_once('includes/ilmp-rgm-script.php');
	}
	add_shortcode('ilmp-rgm', '_ilmp_rgm');

?>