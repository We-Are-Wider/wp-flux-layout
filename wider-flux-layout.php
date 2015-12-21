<?php
/*
 Plugin Name: WP Flux Layout
 Plugin URI: http://wider.co.uk
 Description: Adds Flux Layout responsive CSS framework to your WordPress site. Configure options through the WordPress Customizer (View website -> Top Admin Bar -> Customize).
 Author: Jonny Allbut
 Version: 0.3
 Author URI: https://jonnya.net
*/


/*

Text domain for translation: wp-flux-layout

/////////  VERSION HISTORY

0.1 - Initial work-in-progress
0.2 - Main Wonderflux options working in Customizer (whoot!)
0.3 - More Wonderflux options, refactor code and enqueue Flux Layout files

*/


/**
 *
 * Setup text domain for translation
 * Same name as plugin directory
 *
 */
add_action( 'plugins_loaded', 'wider_fluxl_textdom') ;
function wider_fluxl_textdom() {

	load_plugin_textdomain( 'wp-flux-layout', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

}


/**
 *
 * Deploy Flux Layout CSS
 *
 */
add_action( 'wp_enqueue_scripts', 'wider_fluxl_css' );
function wider_fluxl_css() {

	if ( !is_admin() ) {
		new wider_flux_layout;
	}

}


/**
 *
 * Customizer controls
 *
 */
add_action( 'after_setup_theme','wider_fluxl_customizer', 1 );
function wider_fluxl_customizer() {

	if ( ( is_user_logged_in() && is_customize_preview() ) && current_user_can( 'edit_theme_options' ) ) {
		new wider_flux_layout_customizer;
	}
}


class wider_flux_layout {

	var $version = 0.3;						/* Plugin version */
	var $defaults = false;					/* Holds default values for all options */
	var $db_key = 'wp_flux_layout';			/* Sets up option_name, switch to Wonderflux options if required */
	var $datatype = 'theme_mod';			/* How data is saved - theme_mod or option for Wonderflux */
	var $default_vals = array(
			'columns_num'	=> 16,
			'container_w'	=> 80,
			'container_p'	=> 'middle',
			'rwd_full'		=> 'small',
			'content_s'		=> 'three_quarter',
			'sidebar_s'		=> 'quarter',
			'sidebar_d'		=> 'Y',
			'sidebar_p'		=> 'left',
			'content_s_px'	=> '400',
			'page_t'		=> '',
			'doc_type'		=> 'transitional',
			'doc_lang'		=> 'en'
		);

	function __construct() {

	    // WORK IN PROGRESS - Wonderflux theme framework options integration, cute!
		if ( class_exists( 'wflux_theme_all' ) ) {

			$this->db_key = 'wonderflux_display';
			$this->datatype = 'option';

		// Added as a plugin, need Flux Layout!
		} else {

			include_once( plugin_dir_path( __FILE__ ) . '/wider-flux-css.php' );
			new flux_layout_css;

		}

	}

}


class wider_flux_layout_customizer {

	function __construct() {

		include_once( plugin_dir_path( __FILE__ ) . '/wider-flux-customizer.php' );
		new flux_layout_customizer;

	}

}


?>