<?php
/**
 * Template Name: Properties Search Full Width
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

<!-- Search
================================================== -->
<section class="search margin-bottom-50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<!-- Title -->
				<h3 class="search-title"><?php esc_html_e('Search','findeo'); ?>
				<?php if(isset($_GET['keyword_search'])) : ?>	<a id="realteo_reset_filters" href="#"><?php esc_html_e('Reset Filters','findeo'); ?></a> <?php endif; ?>
				</h3>
	<!-- Form -->
				<div class="main-search-box no-shadow">
					<?php echo do_shortcode('[realteo_search_form source="fw"]'); ?>
		
				</div>
				<!-- Box / End -->
			</div>
		</div>
	</div>
</section>

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