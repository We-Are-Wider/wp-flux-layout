<?php
/**
 * Register and enqueue all CSS.
 * Not used if we are using Wonderflux thanks!
 *
 * @since	0.3
 * @version	0.3
 *
 */
class flux_layout_css extends wider_flux_layout {


	function __construct() {

		$this->structure();
		$this->columns();

	}


	/**
	 * Inserts the core structure static CSS.
	 *
	 * Filters available:
	 * fluxl_css_core_path - full path to file
	 *
	 * @since	0.3
	 * @version	0.3
	 *
	 * @param	none
	 */
	function structure() {

		$path = apply_filters( 'fluxl_css_core_path', plugins_url( '/flux-layout/flux-layout-core.css', __FILE__ ) );

		wp_register_style( 'flux-layout-core', esc_url( $path ), '', $this->version, 'screen, projection' );
		wp_enqueue_style( 'flux-layout-core' );

	}


	/**
	 * Inserts the core structure dynamic layout CSS.
	 *
	 * Filters available:
	 * fluxl_css_layout_path - full path to file
	 *
	 * @since	0.3
	 * @version	0.3
	 *
	 * @param	none
	 * @todo 	Optimise so we only filter 1 specific CSS file on style_loader_tag
	 */
	function columns() {

		$path = apply_filters( 'fluxl_css_layout_path', plugins_url( '/flux-layout/flux-layout.php', __FILE__ ) );
		$version = 'wfx-dynamic'; /* IMPORTANT - No changing, we filter off this and build values for dynamic grid */

		wp_register_style( 'flux-layout', esc_url( $path ), '', $version, 'screen, projection' );
		wp_enqueue_style( 'flux-layout' );

		// IMPORTANT - Append layout arguments to url
		add_filter( 'style_loader_tag', array($this,'css_add_args') );

	}


	/**
	 * Used to filter in CSS sizing parameters
	 *
	 * @since	0.3
	 * @version	0.3
	 *
	 * @param	$input - from style_loader_tag (filter)
	 * @todo	Setup values for filtering
	 */
	function css_add_args($input) {

		//echo $input;

		//print_r( get_theme_mod( $this->db_key ) );

		$data = get_theme_mod( $this->db_key );
		$columns = ( array_key_exists('columns_num', $data ) && is_numeric( $data['columns_num'] ) ) ? $data['columns_num'] : $this->default_vals['columns_num'];
		$position = ( array_key_exists('container_p', $data ) && !empty( $data['container_p'] ) ) ? $data['container_p'] : $this->default_vals['container_p'];
		$sb_position = ( array_key_exists('sidebar_p', $data ) && !empty( $data['sidebar_p'] ) ) ? $data['sidebar_p'] : $this->default_vals['sidebar_p'];
		$container_w = ( array_key_exists('container_w', $data ) && !empty( $data['container_w'] ) ) ? $data['container_w'] : $this->default_vals['container_w'];

		$vars = '&amp;w=' . $container_w
		. '&amp;wu=' . 'percent'
		. '&amp;p=' . $position
		. '&amp;sbp=' . $sb_position
		. '&amp;c=' . $columns;

		return str_replace(array('ver=wfx-dynamic'), array($vars), $input);

	}


}