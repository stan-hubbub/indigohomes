<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package findeo
 */

get_header(get_option('header_bar_style','standard') ); ?>

<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
				<h2><?php echo get_option('findeo_blog_title','Blog'); ?></h2>
				<span><?php echo get_option('findeo_blog_subtitle','Latest News'); ?></span>
	
				<!-- Breadcrumbs -->
				<?php if(function_exists('bcn_display')) { ?>
                    <nav id="breadcrumbs">
                        <ul>
                            <?php bcn_display_list(); ?>
                        </ul>
                    </nav>
                <?php } ?>

			</div>
		</div>
	</div>
</div>
<?php 
$sidebar_side = get_option('pp_blog_layout'); 
?>
<!-- Content
================================================== -->
<div class="container <?php echo esc_attr($sidebar_side) ?>">

	<!-- Blog Posts -->
	<div class="blog-page">
		<div class="row">
			<div class="col-md-8">

			<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'blog-parts/content', get_post_format() );

				endwhile;

				?>
				<div class="pagination-container margin-top-45  margin-bottom-20">
					<nav class="pagination">
					<?php
						if(function_exists('wp_pagenavi')) { 
							wp_pagenavi(array(
								'next_text' => '<i class="fa fa-chevron-right"></i>',
								'prev_text' => '<i class="fa fa-chevron-left"></i>',
								'use_pagenavi_css' => false,
								));
						} else {
							the_posts_navigation();	
						}?>
					</nav>
				</div>
				<?php

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			
			</div>

			<!-- Widgets -->
			<div class="col-md-4">
				<div class="sidebar right">
					<?php get_sidebar(); ?>
				</div>
			</div>
			<!-- Sidebar / End -->
		</div>
	<!-- Sidebar / End -->

	</div>

</div>

<?php get_footer(); ?>