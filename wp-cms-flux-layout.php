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

	if ( is_user_logged_in() && current_user_can('edit_theme_options') ) {
		// Do it!
		$wpcms_fluxl_controls = ( is_customize_preview() ) ? new wpcms_flux_layout : false;
	}

}
add_action( 'after_setup_theme','wpcms_fluxl_controls', 1 );


/**
 *
 * All the widget control functionality
 *
 */
class wpcms_flux_layout {


	var $db_key = 'wpcms_flux_layout';		/* Sets up option_name prepend string so we can switch to Wonderflux options if required */
	var $defaults = false;					/* Holds default values for all options */
	var $common_size = false;				/* Holds default values for size options */


	function __construct() {

	    // EXPERIMENTAL - Wonderflux theme framework options integration, cute!
		$this->db_key = ( class_exists('wflux_theme_all') ) ? 'wonderflux_display' : 'wpcms_flux_layout';

		// IMPORTANT - Setup default values for options and use elsewhere
		$this->defaults = array(
			'columns_num'	=> 16,
			'container_w'	=> 80,
			'container_p'	=> 'middle',
			'rwd_full'		=> 'small',
			'content_s'		=> 'three_quarter',
			'sidebar_s'		=> 'quarter',
			'sidebar_d'		=> 'Y',
			'sidebar_p'		=> 'left',
			'content_s_px'	=> '400',
		);

		// Note that value/labels around other way for customizer compared to Wonderflux core!
		$this->common_size = array(
			'full' => esc_attr__('Full','wpcms-flux-layout'),
			'half' => esc_attr__('Half','wpcms-flux-layout'),
			// 'third' => esc_attr__('1 Third','wpcms-flux-layout'),
			// 'two_third' => esc_attr__('- 2 Thirds','wpcms-flux-layout'),
			'quarter' => esc_attr__('1 Quarter','wpcms-flux-layout'),
			'two_quarter' => esc_attr__('- 2 Quarters','wpcms-flux-layout'),
			'three_quarter' => esc_attr__('- 3 Quarters','wpcms-flux-layout'),
			'fifth' => esc_attr__('1 Fifth','wpcms-flux-layout'),
			'two_fifth' => esc_attr__('- 2 Fifths','wpcms-flux-layout'),
			'three_fifth' => esc_attr__('- 3 Fifths','wpcms-flux-layout'),
			'four_fifth' => esc_attr__('- 4 Fifths','wpcms-flux-layout'),
			// 'sixth' => esc_attr__('1 Sixth','wpcms-flux-layout'),
			// 'two_sixth' => esc_attr__('- 2 Sixths','wpcms-flux-layout'),
			// 'three_sixth' => esc_attr__('- 3 Sixths','wpcms-flux-layout'),
			// 'four_sixth' => esc_attr__('- 4 Sixths','wpcms-flux-layout'),
			// 'five_sixth' => esc_attr__('- 5 Sixths','wpcms-flux-layout'),
			// 'seventh' => esc_attr__('1 Seventh','wpcms-flux-layout'),
			// 'two_seventh' => esc_attr__('- 2 Sevenths','wpcms-flux-layout'),
			// 'three_seventh' => esc_attr__('- 3 Sevenths','wpcms-flux-layout'),
			// 'four_seventh' => esc_attr__('- 4 Sevenths','wpcms-flux-layout'),
			// 'five_seventh' => esc_attr__('- 5 Sevenths','wpcms-flux-layout'),
			// 'six_seventh' => esc_attr__('- 6 Sevenths','wpcms-flux-layout'),
			'eighth' => esc_attr__('1 Eigth','wpcms-flux-layout'),
			'two_eighth' => esc_attr__('- 2 Eigths','wpcms-flux-layout'),
			'three_eighth' => esc_attr__('- 3 Eigths','wpcms-flux-layout'),
			'four_eighth' => esc_attr__('- 4 Eigths','wpcms-flux-layout'),
			'five_eighth' => esc_attr__('- 5 Eigths','wpcms-flux-layout'),
			'six_eighth' => esc_attr__('- 6 Eigths','wpcms-flux-layout'),
			'seven_eighth' => esc_attr__('- 7 Eigths','wpcms-flux-layout'),
			// 'ninth' => esc_attr__('1 Ninth','wpcms-flux-layout'),
			// 'two_ninth' => esc_attr__('- 2 Ninths','wpcms-flux-layout'),
			// 'three_ninth' => esc_attr__('- 3 Ninths','wpcms-flux-layout'),
			// 'four_ninth' => esc_attr__('- 4 Ninths','wpcms-flux-layout'),
			// 'five_ninth' => esc_attr__('- 5 Ninths','wpcms-flux-layout'),
			// 'six_ninth' => esc_attr__('- 6 Ninths','wpcms-flux-layout'),
			// 'seven_ninth' => esc_attr__('- 7 Ninths','wpcms-flux-layout'),
			// 'eight_ninth' => esc_attr__('- 8 Ninths','wpcms-flux-layout'),
			'tenth' => esc_attr__('1 Tenth','wpcms-flux-layout'),
			'two_tenth' => esc_attr__('- 2 Tenths','wpcms-flux-layout'),
			'three_tenth' => esc_attr__('- 3 Tenths','wpcms-flux-layout'),
			'four_tenth' => esc_attr__('- 4 Tenths','wpcms-flux-layout'),
			'five_tenth' => esc_attr__('- 5 Tenths','wpcms-flux-layout'),
			'six_tenth' => esc_attr__('- 6 Tenths','wpcms-flux-layout'),
			'seven_tenth' => esc_attr__('- 7 Tenths','wpcms-flux-layout'),
			'eight_tenth' => esc_attr__('- 8 Tenths','wpcms-flux-layout'),
			'nine_tenth' => esc_attr__('- 9 Tenths','wpcms-flux-layout'),
			// 'eleventh' => esc_attr__('1 Eleventh','wpcms-flux-layout'),
			// 'two_eleventh' => esc_attr__('- 2 Elevenths','wpcms-flux-layout'),
			// 'three_eleventh' => esc_attr__('- 3 Elevenths','wpcms-flux-layout'),
			// 'four_eleventh' => esc_attr__('- 4 Elevenths','wpcms-flux-layout'),
			// 'five_eleventh' => esc_attr__('- 5 Elevenths','wpcms-flux-layout'),
			// 'six_eleventh' => esc_attr__('- 6 Elevenths','wpcms-flux-layout'),
			// 'seven_eleventh' => esc_attr__('- 7 Elevenths','wpcms-flux-layout'),
			// 'eight_eleventh' => esc_attr__('- 8 Elevenths','wpcms-flux-layout'),
			// 'nine_eleventh' => esc_attr__('- 9 Elevenths','wpcms-flux-layout'),
			// 'ten_eleventh' => esc_attr__('- 10 Elevenths','wpcms-flux-layout'),
			// 'twelveth' => esc_attr__('1 Twelveth','wpcms-flux-layout'),
			// 'two_twelveth' => esc_attr__('- 2 Twelveths','wpcms-flux-layout'),
			// 'three_twelveth' => esc_attr__('- 3 Twelveths','wpcms-flux-layout'),
			// 'four_twelveth' => esc_attr__('- 4 Twelveths','wpcms-flux-layout'),
			// 'five_twelveth' => esc_attr__('- 5 Twelveths','wpcms-flux-layout'),
			// 'six_twelveth' => esc_attr__('- 6 Twelveths','wpcms-flux-layout'),
			// 'seven_twelveth' => esc_attr__('- 7 Twelveths','wpcms-flux-layout'),
			// 'eight_twelveth' => esc_attr__('- 8 Twelveths','wpcms-flux-layout'),
			// 'nine_twelveth' => esc_attr__('- 9 Twelveths','wpcms-flux-layout'),
			// 'ten_twelveth' => esc_attr__('- 10 Twelveths','wpcms-flux-layout'),
			// 'eleven_twelveth' => esc_attr__('- 11 Twelveths','wpcms-flux-layout')
		);

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

		// Common Flux Layout controls
		$controls = array(

			$this->db_key . '[columns_num]' => array(
				'label'		=> esc_html__( 'Number of Vertical columns', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Number of vertical columns in your main layout. Flux Layout also includes other common columns configurations automatically.', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> $this->defaults['columns_num'],
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
				'default'	=> $this->defaults['container_w'],
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
				'default'	=> $this->defaults['container_p'],
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_core',
				'type'		=> 'select',
				'choices'	=> array(
								'left'		=> 'Left',
								'middle'	=> 'Middle',
								'right'		=> 'Right'
							   ),
				'sanitize'	=> 'no_html'
			),

		);

		// Wonderflux specific controls
		$wfx_controls = array(

			/* Content and sidebar */

			$this->db_key . '[rwd_full]' => array(
				'label'		=> esc_html__( 'Sidebar/main content breakpoint', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Media query breakpoint for when sidebar and content goes full width for smaller screens.', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> $this->defaults['rwd_full'],
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_content',
				'type'		=> 'select',
				'choices'	=> array(
								'tiny'		=> 'Tiny',
								'small'		=> 'Small',
								'medium'	=> 'Medium',
								'large'		=> 'Large'
							   ),
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[content_s]' => array(
				'label'		=> esc_html__( 'Content width', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Relative size to site width.', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> $this->defaults['content_s'],
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_content',
				'type'		=> 'select',
				'choices'	=> $this->common_size,
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[sidebar_s]' => array(
				'label'		=> esc_html__( 'Sidebar width', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Relative size to site width.', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> $this->defaults['sidebar_s'],
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_content',
				'type'		=> 'select',
				'choices'	=> $this->common_size,
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[sidebar_d]' => array(
				'label'		=> esc_html__( 'Sidebar display', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Do you want to show or hide the sidebar sitewide (can override with filter.)', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> $this->defaults['sidebar_d'],
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_content',
				'type'		=> 'select',
				'choices'	=> array(
								'Y'		=> 'Show',
								'N'		=> 'Hide'
							   ),
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[sidebar_p]' => array(
				'label'		=> esc_html__( 'Sidebar position', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Position sidebar left or right of the main content.', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> $this->defaults['sidebar_p'],
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_content',
				'type'		=> 'select',
				'choices'	=> array(
								'left'		=> 'Left',
								'right'		=> 'Right'
							   ),
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[content_s_px]' => array(
				'label'		=> esc_html__( 'Media width', 'wpcms-flux-layout' ),
				'desc'		=> esc_html__( 'Sets WordPress $content_width. Pixel width of embeded media such as YouTube - Flux Layout makes this responsive for you.', 'wpcms-flux-layout' ),
				'datatype'	=> 'option',
				'default'	=> $this->defaults['content_s_px'],
				'transport'	=> 'refresh',
				'section'	=> 'wpcms_fluxl_content',
				'type'		=> 'select_range',
				'val_low'	=> 200,
				'val_high'	=> 1200,
				'val_step'	=> 5,
				'sanitize'	=> 'numeric'
			)

		);

		// Merged extra Wonderflux controls into array for setup if required
		$controls = ( $this->db_key == 'wonderflux_display' ) ? array_merge( $controls, $wfx_controls ) : $controls;

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