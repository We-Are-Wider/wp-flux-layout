<?php
/**
 * Customizer controls
 *
 * @since	0.1
 * @version	0.4
 *
 */
class flux_layout_customizer extends wider_flux_layout {

	var $common_size = false;				/* Holds default values for size options */

	function __construct() {

	    // WORK IN PROGRESS - Wonderflux theme framework options integration, cute!
		if ( class_exists('wflux_theme_all') ) {
			$this->db_key = 'wonderflux_display';
			$this->datatype = 'option';
		}

		// Note that value/labels around other way for customizer compared to Wonderflux core!
		$this->common_size = array(
			'full' => esc_attr__('Full','wider-flux-layout'),
			'half' => esc_attr__('Half','wider-flux-layout'),
			// 'third' => esc_attr__('1 Third','wider-flux-layout'),
			// 'two_third' => esc_attr__('- 2 Thirds','wider-flux-layout'),
			'quarter' => esc_attr__('1 Quarter','wider-flux-layout'),
			'two_quarter' => esc_attr__('- 2 Quarters','wider-flux-layout'),
			'three_quarter' => esc_attr__('- 3 Quarters','wider-flux-layout'),
			'fifth' => esc_attr__('1 Fifth','wider-flux-layout'),
			'two_fifth' => esc_attr__('- 2 Fifths','wider-flux-layout'),
			'three_fifth' => esc_attr__('- 3 Fifths','wider-flux-layout'),
			'four_fifth' => esc_attr__('- 4 Fifths','wider-flux-layout'),
			// 'sixth' => esc_attr__('1 Sixth','wider-flux-layout'),
			// 'two_sixth' => esc_attr__('- 2 Sixths','wider-flux-layout'),
			// 'three_sixth' => esc_attr__('- 3 Sixths','wider-flux-layout'),
			// 'four_sixth' => esc_attr__('- 4 Sixths','wider-flux-layout'),
			// 'five_sixth' => esc_attr__('- 5 Sixths','wider-flux-layout'),
			// 'seventh' => esc_attr__('1 Seventh','wider-flux-layout'),
			// 'two_seventh' => esc_attr__('- 2 Sevenths','wider-flux-layout'),
			// 'three_seventh' => esc_attr__('- 3 Sevenths','wider-flux-layout'),
			// 'four_seventh' => esc_attr__('- 4 Sevenths','wider-flux-layout'),
			// 'five_seventh' => esc_attr__('- 5 Sevenths','wider-flux-layout'),
			// 'six_seventh' => esc_attr__('- 6 Sevenths','wider-flux-layout'),
			'eighth' => esc_attr__('1 Eigth','wider-flux-layout'),
			'two_eighth' => esc_attr__('- 2 Eigths','wider-flux-layout'),
			'three_eighth' => esc_attr__('- 3 Eigths','wider-flux-layout'),
			'four_eighth' => esc_attr__('- 4 Eigths','wider-flux-layout'),
			'five_eighth' => esc_attr__('- 5 Eigths','wider-flux-layout'),
			'six_eighth' => esc_attr__('- 6 Eigths','wider-flux-layout'),
			'seven_eighth' => esc_attr__('- 7 Eigths','wider-flux-layout'),
			// 'ninth' => esc_attr__('1 Ninth','wider-flux-layout'),
			// 'two_ninth' => esc_attr__('- 2 Ninths','wider-flux-layout'),
			// 'three_ninth' => esc_attr__('- 3 Ninths','wider-flux-layout'),
			// 'four_ninth' => esc_attr__('- 4 Ninths','wider-flux-layout'),
			// 'five_ninth' => esc_attr__('- 5 Ninths','wider-flux-layout'),
			// 'six_ninth' => esc_attr__('- 6 Ninths','wider-flux-layout'),
			// 'seven_ninth' => esc_attr__('- 7 Ninths','wider-flux-layout'),
			// 'eight_ninth' => esc_attr__('- 8 Ninths','wider-flux-layout'),
			'tenth' => esc_attr__('1 Tenth','wider-flux-layout'),
			'two_tenth' => esc_attr__('- 2 Tenths','wider-flux-layout'),
			'three_tenth' => esc_attr__('- 3 Tenths','wider-flux-layout'),
			'four_tenth' => esc_attr__('- 4 Tenths','wider-flux-layout'),
			'five_tenth' => esc_attr__('- 5 Tenths','wider-flux-layout'),
			'six_tenth' => esc_attr__('- 6 Tenths','wider-flux-layout'),
			'seven_tenth' => esc_attr__('- 7 Tenths','wider-flux-layout'),
			'eight_tenth' => esc_attr__('- 8 Tenths','wider-flux-layout'),
			'nine_tenth' => esc_attr__('- 9 Tenths','wider-flux-layout'),
			// 'eleventh' => esc_attr__('1 Eleventh','wider-flux-layout'),
			// 'two_eleventh' => esc_attr__('- 2 Elevenths','wider-flux-layout'),
			// 'three_eleventh' => esc_attr__('- 3 Elevenths','wider-flux-layout'),
			// 'four_eleventh' => esc_attr__('- 4 Elevenths','wider-flux-layout'),
			// 'five_eleventh' => esc_attr__('- 5 Elevenths','wider-flux-layout'),
			// 'six_eleventh' => esc_attr__('- 6 Elevenths','wider-flux-layout'),
			// 'seven_eleventh' => esc_attr__('- 7 Elevenths','wider-flux-layout'),
			// 'eight_eleventh' => esc_attr__('- 8 Elevenths','wider-flux-layout'),
			// 'nine_eleventh' => esc_attr__('- 9 Elevenths','wider-flux-layout'),
			// 'ten_eleventh' => esc_attr__('- 10 Elevenths','wider-flux-layout'),
			// 'twelveth' => esc_attr__('1 Twelveth','wider-flux-layout'),
			// 'two_twelveth' => esc_attr__('- 2 Twelveths','wider-flux-layout'),
			// 'three_twelveth' => esc_attr__('- 3 Twelveths','wider-flux-layout'),
			// 'four_twelveth' => esc_attr__('- 4 Twelveths','wider-flux-layout'),
			// 'five_twelveth' => esc_attr__('- 5 Twelveths','wider-flux-layout'),
			// 'six_twelveth' => esc_attr__('- 6 Twelveths','wider-flux-layout'),
			// 'seven_twelveth' => esc_attr__('- 7 Twelveths','wider-flux-layout'),
			// 'eight_twelveth' => esc_attr__('- 8 Twelveths','wider-flux-layout'),
			// 'nine_twelveth' => esc_attr__('- 9 Twelveths','wider-flux-layout'),
			// 'ten_twelveth' => esc_attr__('- 10 Twelveths','wider-flux-layout'),
			// 'eleven_twelveth' => esc_attr__('- 11 Twelveths','wider-flux-layout')
		);

		// Create customiser controls
		add_action('customize_register', array($this, 'customizer_do') );

	}


	function customizer_do($wp_customize){

		//////// PANELS ////////

		$wp_customize->add_panel( 'wider_flux_layout', array(
		  'title'			=> ( $this->db_key == 'wonderflux_display' ) ? esc_html__( 'Wonderflux', 'wider-flux-layout' ) : esc_html__( 'Flux Layout', 'wider-flux-layout' ),
		  'description'		=> __( wp_kses_post('Flux Layout Generates a dynamic responsive CSS grid - any columns, any width (almost!). <a href="http://fluxlayout.com" target="_blank">Visit the Flux Layout website</a> for more information on how to use this.'), 'wider-flux-layout' ),
		  // 'priority'		=> 20
		) );

		//////// SECTIONS ////////

		$wp_customize->add_section('wider_fluxl_core', array(
			'title'			=> esc_html__( 'Layout', 'wider-flux-layout' ),
			'description'	=> esc_html__( 'Setup the dimensions of your CSS layout columns (grid system).', 'wider-flux-layout' ),
			'panel'			=> 'wider_flux_layout'
		));

		$wp_customize->add_section('wider_fluxl_content', array(
			'title'			=> esc_html__( 'Content and sidebar', 'wider-flux-layout' ),
			'description'	=> esc_html__( 'Setup the dimensions of your main content area and sidebar.', 'wider-flux-layout' ),
			'panel'			=> 'wider_flux_layout'
		));

		$wp_customize->add_section('wider_fluxl_config', array(
			'title'			=> esc_html__( 'Configuration', 'wider-flux-layout' ),
			'description'	=> esc_html__( 'Configure other Wonderflux settings.', 'wider-flux-layout' ),
			'panel'			=> 'wider_flux_layout'
		));

		////// CONTROLS //////

		// Common Flux Layout controls
		$controls = array(

			$this->db_key . '[columns_num]' => array(
				'label'		=> esc_html__( 'Number of Vertical columns', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Number of vertical columns in your main layout. Flux Layout also includes other common columns configurations automatically.', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['columns_num'],
				'transport'	=> 'refresh',
				'section'	=> 'wider_fluxl_core',
				'type'		=> 'select_range',
				'val_low'	=> 2,
				'val_high'	=> 100,
				'val_step'	=> 1,
				'sanitize'	=> 'numeric'
			),

			$this->db_key . '[container_w]' => array(
				'label'		=> esc_html__( 'Main container width', 'wider-flux-layout' ),
				'desc'		=> esc_html__( '% width of central main content container.', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['container_w'],
				'transport'	=> 'refresh',
				'section'	=> 'wider_fluxl_core',
				'type'		=> 'select_range',
				'val_low'	=> 5,
				'val_high'	=> 100,
				'val_step'	=> 5,
				'sanitize'	=> 'numeric'
			),

			$this->db_key . '[container_p]' => array(
				'label'		=> esc_html__( 'Main container position', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Position the main content of the site within the browser viewport.', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['container_p'],
				'transport'	=> 'refresh',
				'section'	=> 'wider_fluxl_core',
				'type'		=> 'select',
				'choices'	=> array(
								'left'		=> 'Left',
								'middle'	=> 'Middle',
								'right'		=> 'Right'
							   ),
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[sidebar_p]' => array(
				'label'		=> esc_html__( 'Sidebar position', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Position sidebar left or right of the main content.', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['sidebar_p'],
				'transport'	=> 'refresh',
				'section'	=> 'wider_fluxl_content',
				'type'		=> 'select',
				'choices'	=> array(
								'left'		=> 'Left',
								'right'		=> 'Right'
							   ),
				'sanitize'	=> 'no_html'
			),

		);

		// Wonderflux specific controls
		$wfx_controls = array(

			/* Main configuration */

			$this->db_key . '[content_s]' => array(
				'label'		=> esc_html__( 'Content width', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Relative size to site width.', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['content_s'],
				'transport'	=> 'refresh',
				'section'	=> 'wider_fluxl_core',
				'type'		=> 'select',
				'choices'	=> $this->common_size,
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[sidebar_s]' => array(
				'label'		=> esc_html__( 'Sidebar width', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Relative size to site width.', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['sidebar_s'],
				'transport'	=> 'refresh',
				'section'	=> 'wider_fluxl_core',
				'type'		=> 'select',
				'choices'	=> $this->common_size,
				'sanitize'	=> 'no_html'
			),

			/* Content and sidebar */

			$this->db_key . '[rwd_full]' => array(
				'label'		=> esc_html__( 'Sidebar/main content breakpoint', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Media query breakpoint for when sidebar and content goes full width for smaller screens.', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['rwd_full'],
				'transport'	=> 'refresh',
				'section'	=> 'wider_fluxl_content',
				'type'		=> 'select',
				'choices'	=> array(
								'tiny'		=> 'Tiny',
								'small'		=> 'Small',
								'medium'	=> 'Medium',
								'large'		=> 'Large'
							   ),
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[sidebar_d]' => array(
				'label'		=> esc_html__( 'Sidebar display', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Do you want to show or hide the sidebar sitewide (can override with filter.)', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['sidebar_d'],
				'transport'	=> 'refresh',
				'section'	=> 'wider_fluxl_content',
				'type'		=> 'select',
				'choices'	=> array(
								'Y'		=> 'Show',
								'N'		=> 'Hide'
							   ),
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[content_s_px]' => array(
				'label'		=> esc_html__( 'Media width', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Sets WordPress $content_width. Pixel width of embeded media such as YouTube - Flux Layout makes this responsive for you.', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['content_s_px'],
				'transport'	=> 'refresh',
				'section'	=> 'wider_fluxl_content',
				'type'		=> 'select_range',
				'val_low'	=> 200,
				'val_high'	=> 1200,
				'val_step'	=> 5,
				'sanitize'	=> 'numeric'
			),

			/* Config */

			$this->db_key . '[doc_type]' => array(
				'label'		=> esc_html__( 'Document type', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Default: transitional', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['doc_type'],
				'transport'	=> 'postMessage',
				'section'	=> 'wider_fluxl_config',
				'type'		=> 'select',
				'choices'	=> array(
					'transitional' => esc_attr__('transitional','wider-flux-layout'),
					'strict' => esc_attr__('strict','wider-flux-layout'),
					'frameset' => esc_attr__('frameset','wider-flux-layout'),
					'1.1' => esc_attr__('1.1','wider-flux-layout'),
					'1.1basic' => esc_attr__('1.1basic','wider-flux-layout'),
					'html5' => esc_attr__('html5','wider-flux-layout'),
					'XHTML/RDFa' => esc_attr__('XHTML/RDFa','wider-flux-layout')
				),
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[doc_lang]' => array(
				'label'		=> esc_html__( 'Document language', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Default: en', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['doc_lang'],
				'transport'	=> 'postMessage',
				'section'	=> 'wider_fluxl_config',
				'type'		=> 'select',
				'choices'	=> array(
					'aa' => 'aa',
					'ab' => 'ab',
					'ae' => 'ae',
					'af' => 'af',
					'ak' => 'ak',
					'am' => 'am',
					'an' => 'an',
					'ar' => 'ar',
					'as' => 'as',
					'av' => 'av',
					'ay' => 'ay',
					'az' => 'az',
					'ba' => 'ba',
					'be' => 'be',
					'bg' => 'bg',
					'bh' => 'bh',
					'bi' => 'bi',
					'bm' => 'bm',
					'bn' => 'bn',
					'bo' => 'bo',
					'br' => 'br',
					'bs' => 'bs',
					'ca' => 'ca',
					'ce' => 'ce',
					'ch' => 'ch',
					'co' => 'co',
					'cr' => 'cr',
					'cs' => 'cs',
					'cu' => 'cu',
					'cv' => 'cv',
					'da' => 'da',
					'de' => 'de',
					'dv' => 'dv',
					'dz' => 'dz',
					'ee' => 'ee',
					'el' => 'el',
					'en' => 'en',
					'eo' => 'eo',
					'es' => 'es',
					'et' => 'et',
					'eu' => 'eu',
					'eu' => 'eu',
					'fa' => 'fa',
					'ff' => 'ff',
					'fi' => 'fi',
					'fj' => 'fj',
					'fo' => 'fo',
					'fr' => 'fr',
					'fy' => 'fy',
					'ga' => 'ga',
					'gd' => 'gd',
					'gl' => 'gl',
					'gn' => 'gn',
					'gu' => 'gu',
					'gv' => 'gv',
					'ha' => 'ha',
					'he' => 'he',
					'hi' => 'hi',
					'ho' => 'ho',
					'hr' => 'hr',
					'ht' => 'ht',
					'hu' => 'hu',
					'hy' => 'hy',
					'hz' => 'hz',
					'ia' => 'ia',
					'id' => 'id',
					'ie' => 'ie',
					'ig' => 'ig',
					'ii' => 'ii',
					'ik' => 'ik',
					'io' => 'io',
					'is' => 'is',
					'it' => 'it',
					'iu' => 'iu',
					'ja' => 'ja',
					'jv' => 'jv',
					'ka' => 'ka',
					'kg' => 'kg',
					'ki' => 'ki',
					'kj' => 'kj',
					'kk' => 'kk',
					'kl' => 'kl',
					'km' => 'km',
					'kn' => 'kn',
					'ko' => 'ko',
					'kr' => 'kr',
					'ks' => 'ks',
					'ku' => 'ku',
					'kv' => 'kv',
					'kw' => 'kw',
					'ky' => 'ky',
					'la' => 'la',
					'lb' => 'lb',
					'lg' => 'lg',
					'li' => 'li',
					'ln' => 'ln',
					'lo' => 'lo',
					'lt' => 'lt',
					'lu' => 'lu',
					'lv' => 'lv',
					'mg' => 'mg',
					'mh' => 'mh',
					'mi' => 'mi',
					'mk' => 'mk',
					'ml' => 'ml',
					'mn' => 'mn',
					'mr' => 'mr',
					'ms' => 'ms',
					'mt' => 'mt',
					'my' => 'my',
					'na' => 'na',
					'nb' => 'nb',
					'nd' => 'nd',
					'ne' => 'ne',
					'ng' => 'ng',
					'nl' => 'nl',
					'nn' => 'nn',
					'no' => 'no',
					'nr' => 'nr',
					'nv' => 'nv',
					'ny' => 'ny',
					'oc' => 'oc',
					'oj' => 'oj',
					'om' => 'om',
					'or' => 'or',
					'os' => 'os',
					'pa' => 'pa',
					'pi' => 'pi',
					'pl' => 'pl',
					'ps' => 'ps',
					'pt' => 'pt',
					'qu' => 'qu',
					'rm' => 'rm',
					'rn' => 'rn',
					'ro' => 'ro',
					'ru' => 'ru',
					'rw' => 'rw',
					'sa' => 'sa',
					'sc' => 'sc',
					'sd' => 'sd',
					'se' => 'se',
					'sg' => 'sg',
					'si' => 'si',
					'sk' => 'sk',
					'sl' => 'sl',
					'sm' => 'sm',
					'sn' => 'sn',
					'so' => 'so',
					'sq' => 'sq',
					'sr' => 'sr',
					'ss' => 'ss',
					'st' => 'st',
					'su' => 'su',
					'sv' => 'sv',
					'sw' => 'sw',
					'ta' => 'ta',
					'te' => 'te',
					'tg' => 'tg',
					'th' => 'th',
					'ti' => 'ti',
					'tk' => 'tk',
					'tl' => 'tl',
					'tn' => 'tn',
					'to' => 'to',
					'tr' => 'tr',
					'ts' => 'ts',
					'tt' => 'tt',
					'tw' => 'tw',
					'ty' => 'ty',
					'ug' => 'ug',
					'uk' => 'uk',
					'ur' => 'ur',
					'uz' => 'uz',
					've' => 've',
					'vi' => 'vi',
					'vo' => 'vo',
					'wa' => 'wa',
					'wo' => 'wo',
					'xh' => 'xh',
					'yi' => 'yi',
					'yo' => 'yo',
					'za' => 'za',
					'zh' => 'zh',
					'zu' => 'zu'
				),
				'sanitize'	=> 'no_html'
			),

			$this->db_key . '[page_t]' => array(
				'label'		=> esc_html__( 'No sidebar template', 'wider-flux-layout' ),
				'desc'		=> esc_html__( 'Hide this Wonderflux page template if it does not suit your child theme (it will be removed from page template dropdown option in admin.)', 'wider-flux-layout' ),
				'datatype'	=> $this->datatype,
				'default'	=> $this->default_vals['page_t'],
				'transport'	=> 'postMessage',
				'section'	=> 'wider_fluxl_config',
				'type'		=> 'select',
				'choices'	=> array(
								'' => 'Show no sidebar template',
								'no-sidebar' => 'Hide no sidebar template'
							   ),
				'sanitize'	=> 'no_html'
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