<?php
/**
 * Template Name: Properties with All Markers Map
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WPVoyager
 */

get_header(get_option('header_bar_style','standard') ); 
?>


<!-- Map
================================================== -->
<div id="map-container">

    <?php 
		$maps = new FindeoMaps;
		echo $maps->show_map();
  	?>

    <!-- Map Navigation -->
	<a href="#" id="scrollEnabling" title="<?php esc_attr_e('Enable or disable scrolling on map','findeo'); ?>"><?php esc_html_e('Enable Scrolling','findeo'); ?></a>
	<ul id="mapnav-buttons">
	     <li><a href="#" id="prevpoint" title="<?php esc_attr_e('Previous point on map','findeo'); ?>"><?php esc_html_e('Prev','findeo'); ?></a></li>
	    <li><a href="#" id="nextpoint" title="<?php esc_attr_e('Next point on map','findeo'); ?>"><?php esc_html_e('Next','findeo'); ?></a></li>
	</ul>

</div>



<?php

while ( have_posts() ) : the_post();

$layout = get_post_meta($post->ID, 'findeo_page_layout', true); if(empty($layout)) { $layout = 'right-sidebar'; }
$class  = ($layout !="full-width") ? "col-md-8" : "col-md-12"; ?>

<div class="container <?php echo esc_attr($layout); ?>">

	<div class="row">

		<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
			<?php the_content(); ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'findeo' ),
					'after'  => '</div>',
				) );
			?>
 
			<?php
		        if(get_option('pp_pagecomments','on') == 'on') {
		        	
		            // If comments are open or we have at least one comment, load up the comment template
		            if ( comments_open() || get_comments_number() ) :
		                comments_template();
		            endif;
		        }
		    ?>

		</article>
		
		<?php if($layout !="full-width") { ?>
			<div class="col-md-4">
				<div class="sidebar right">
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php } ?>

	</div>

</div>
<div class="clearfix"></div>

<div class="margin-top-55"></div>
<?php endwhile; // End of the loop. ?>
<?php get_footer(); ?>