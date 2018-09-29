<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package findeo
 */

	$sidebar = false;

	if( is_singular() ) {
		$sidebar = get_post_meta( get_the_ID(), 'findeo_sidebar_select', true );
		
	}
	if( ! $sidebar ) {
		$sidebar = 'sidebar-property';			
	}
		
	if( is_active_sidebar( $sidebar ) ) {
		dynamic_sidebar( $sidebar );
	}

?>