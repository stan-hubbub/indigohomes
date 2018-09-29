<?php
/**
 * The template for displaying archive pages
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
				
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
	
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

<!-- Content
================================================== -->
<div class="container">

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

				the_posts_navigation();

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