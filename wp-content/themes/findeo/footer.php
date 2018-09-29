<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package findeo
 */

?>

<!-- Footer
================================================== -->
<?php 
$sticky = get_option('findeo_sticky_footer') ;
$style = get_option('findeo_footer_style') ;

if(is_singular()){

	$sticky_singular = get_post_meta($post->ID, 'findeo_sticky_footer', TRUE); 
	
	switch ($sticky_singular) {
		case 'on':
		case 'enable':
			$sticky = true;
			break;

		case 'disable':
			$sticky = false;
			break;	

		case 'use_global':
			$sticky = get_option('findeo_sticky_footer'); 
			break;
		
		default:
			$sticky = get_option('findeo_sticky_footer'); 
			break;
	}

	$style_singular = get_post_meta($post->ID, 'findeo_footer_style', TRUE); 
	switch ($style_singular) {
		case 'light':
			$style = 'light';
			break;

		case 'dark':
			$style = 'dark';
			break;

		case 'use_global':
			$style = get_option('findeo_footer_style'); 
			break;
		
		default:
			$style = get_option('findeo_footer_style'); 
			break;
	}
}

$sticky = apply_filters('findeo_sticky_footer_filter',$sticky);
?>
<div id="footer" class="<?php echo esc_attr($style); echo ($sticky == 'on' || $sticky == 1 || $sticky == true) ? " sticky-footer" : ''; ?> ">
	<!-- Main -->
	<div class="container">
		<div class="row">
			<?php
			$footer_layout = get_option( 'pp_footer_widgets','6,3,3' ); 
			
	        $footer_layout_array = explode(',', $footer_layout); 
	        $x = 0;
	        foreach ($footer_layout_array as $value) {
	            $x++;
	             ?>
	             <div class="col-md-<?php echo esc_attr($value); ?> col-sm-6 col-xs-12">
	                <?php
					if( is_active_sidebar( 'footer'.$x ) ) {
						dynamic_sidebar( 'footer'.$x );
					}
	                ?>
	            </div>
	        <?php } ?>

		</div>
		<!-- Copyright -->
		<div class="row">
			<div class="col-md-12">
				<div class="copyrights"> <?php $copyrights = get_option( 'pp_copyrights' , '&copy; Theme by Purethemes.net. All Rights Reserved.' ); 
		
		        if (function_exists('icl_register_string')) {
		            icl_register_string('Copyrights in footer','copyfooter', $copyrights);
		            echo icl_t('Copyrights in footer','copyfooter', $copyrights);
		        } else {
		            echo wp_kses($copyrights,array( 'a' => array('href' => array(),'title' => array()),'br' => array(),'em' => array(),'strong' => array(),));
		        } ?></div>
			</div>
		</div>
	</div>
</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div> <!-- weof wrapper -->
<?php wp_footer(); ?></body>
</html>