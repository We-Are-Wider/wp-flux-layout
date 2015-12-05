<?php
/*
 Plugin Name: WP-CMS Flux Layout
 Plugin URI: http://wp-cms.com
 Description: Adds the Flux Layout responsive CSS framework to your WordPress site. Configure options through the WordPress Customizer (View website -> Top Admin Bar -> Customize).
 Author: Jonny Allbut
 Version: 0.1
 Author URI: http://jonnya.net
*/

/*


/////////  VERSION HISTORY

0.1 - Initial work-in-progress release

*/


/**
 *
 * Setup text domain for translation
 * Same name as plugin directory
 *
 */
function wpcms_fluxl_textdom() {
	load_plugin_textdomain( 'wpcms-flux-layout', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'wpcms_fluxl_textdom') ;


/**
 *
 * Execute plugin
 *
 */
function wpcms_fluxl_controls() {
	$wpcms_fluxl_controls = ( is_customize_preview() ) ? new wpcms_flux_layout : false;
}
add_action( 'after_setup_theme','wpcms_fluxl_controls', 1 );


/**
 *
 * All the widget control functionality
 *
 */
class wpcms_flux_layout {

	var $db_key = 'wpcms_flux_layout';		/* Sets up option_name prepend string so we can switch to Wonderflux options if required */

	function __construct() {

	    // EXPERIMENTAL - Wonderflux theme framework options integration, cute!
		$this->db_key = ( class_exists('wflux_theme_all') ) ? 'wonderflux_display' : 'wpcms_flux_layout';
		// Create customiser controls
		add_action('customize_register', array($this, 'customizer_do') );

	}


	function customizer_do($wp_customize){

		//////// PANELS ////////

		$wp_customize->add_panel( 'wpcms_flux_layout', array(
		  'title'			=> ( $this->db_key == 'wonderflux_display' ) ? esc_html__( 'Wonderflux', 'wpcms-flux-layout' ) : esc_html__( 'Flux Layout', 'wpcms-flux-layout' ),
		  'description'		=> __( wp_kses_post('Flux Layout Generates a dynamic responsive CSS grid - any columns, any width (almost!). <a href="http://fluxlayout.com" target="_blank">Visit the Flux Layout website</a> for more information on how to use this.'), 'wpcms-flux-layout' ),
		  // 'priority'		=> 20
		) );

		//////// SECTIONS ////////

		$wp_customize->add_section('wpcms_fluxl_core', array(
			'title'			=> esc_html__( 'Main configuration', 'wpcms-flux-layout' ),
			'description'	=> esc_html__( 'Setup the dimensions of your CSS layout columns (grid system).', 'wpcms-flux-layout' ),
			'panel'			=> 'wpcms_flux_layout'
		));

		$wp_customize->add_section('wpcms_fluxl_content', array(
			'title'			=> esc_html__( 'Content and sidebar', 'wpcms-flux-layout' ),
			'description'	=> esc_html__( 'Setup the dimensions of your main content area and sidebar.', 'wpcms-flux-layout' ),
			'panel'			=> 'wpcms_flux_layout'
		));

		////// CONTROLS //////
		// Site param = 'subsites', 'all'

		$controls = array(

			/* Main config */

			$this->db_key . '[columns_num]' => array(
				'label'		=> esc_html__( 'Number of Vertical columns', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Number of vertical columns in your main layout. Flux Layout also includes other common columns configurations automatically.', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> 16,
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_core',
				'type'		=> 'select_range',
				'val_low'	=> 2,
				'val_high'	=> 100,
				'val_step'	=> 1,
				'sanitize'	=> 'numeric'
			),

			$this->db_key . '[container_w]' => array(
				'label'		=> esc_html__( 'Main container width', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( '% width of central main content container.', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> 80,
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_core',
				'type'		=> 'select_range',
				'val_low'	=> 5,
				'val_high'	=> 100,
				'val_step'	=> 5,
				'sanitize'	=> 'numeric'
			),

			$this->db_key . '[container_p]' => array(
				'label'		=> esc_html__( 'Main container position', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Position the main content of the site within the browser viewport.', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> 'middle',
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_core',
				'type'		=> 'select',
				'choices'	=> array(
								'left'		=> 'left',
								'middle'	=> 'middle',
								'right'		=> 'right'
							   ),
				'sanitize'	=> 'no_html'
			),

			/* Content and sidebar */

			$this->db_key . '[content_s]' => array(
				'label'		=> esc_html__( 'Content width (relative size)', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Moomin2', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> 500,
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_content',
				'type'		=> 'text',
				'sanitize'	=> 'numeric'
			)

		);

		// Build the controls
		foreach ( $controls as $opt => $val ) {

			$wp_customize->add_setting( $opt, array(
				'type'						=> $val['datatype'], // option or theme_mod
				'default'					=> ( isset($val['default']) ) ? $val['default'] : false,
				'transport'					=> $val['transport'], // refresh or postMessage
				'sanitize_callback'			=> ( isset($val['sanitize']) ) ? array( $this, 'sanitize_' . $val['sanitize'] ) : false,
				'sanitize_js_callback'		=> ( isset($val['sanitize']) ) ? array( $this, 'sanitize_' . $val['sanitize'] ) : false

			));

			switch ( $val['type'] ) {

				case 'image_upload':

					$wp_customize->add_control(
						new WP_Customize_Upload_Control( $wp_customize, $opt,
						array(
							'label'			=> $val['label'],
							'section'		=> $val['section'],
							'settings'		=> $opt,
							'description'	=> ( isset($val['desc']) ) ? $val['desc'] : false
						)
					));

				break;

				case 'select':

					$wp_customize->add_control( $opt, array(
						'label'   			=> $val['label'],
						'section' 			=> $val['section'],
						'type'    			=> $val['type'],
						'choices'			=> $val['choices'],
						'description'		=> ( isset($val['desc']) ) ? $val['desc'] : false
					));

				break;

				case 'select_range':

					$vals = $this->helper_int_range($val['val_low'], $val['val_high'], $val['val_step']);

					$wp_customize->add_control( $opt, array(
						'label'   			=> $val['label'],
						'section' 			=> $val['section'],
						'type'    			=> 'select',
						'choices'			=> $vals,
						'description'		=> ( isset($val['desc']) ) ? $val['desc'] : false
					));

				break;

				default:

					$wp_customize->add_control( $opt, array(
						'label'   			=> $val['label'],
						'section' 			=> $val['section'],
						'type'    			=> $val['type'],
						'description'		=> ( isset($val['desc']) ) ? $val['desc'] : false
					));

				break;

			}

		}

	}


	/**
	 * Returns array of values numeric ready to use with dropdown
	 *
	 * @param  [integer]	$low Number where youd like to start
	 * @param  [integer]	$high Number where youd like to end
	 * @param  [integer]	$step Increase number by how many each time
	 * @return [array]		Array of numbers
	 */
	function helper_int_range( $low, $high, $step=1 ) {

		$items = range( $low,$high,$step );
		$output = array();
		foreach ($items as $val) { $output[$val] = $val; }
		return $output;

	}


	/**
	 * Common customizer sanitization callback function
	 */
	function sanitize_numeric( $input ) {
		return ( isset($input) && is_numeric($input) ) ? $input : false;
	}


	/**
	 * Common customizer sanitization callback function
	 */
	function sanitize_no_html( $input ) {
		return ( isset($input) ) ? wp_filter_nohtml_kses( trim($input) ) : false;
	}


	/**
	 * Common customizer sanitization callback function
	 */
	function sanitize_checkbox( $input ) {
		return ( isset($input) && $input === true ) ? true : false;
	}


}
?>