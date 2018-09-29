<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Findeo
 */

get_header(get_option('header_bar_style','standard') ); 

$layout = get_post_meta($post->ID, 'findeo_page_layout', true); if(empty($layout)) { $layout = 'right-sidebar'; }
$class  = ($layout !="full-width") ? "col-md-9 col-sm-7 extra-gutter-right" : "col-md-12"; 
$page_top = get_post_meta($post->ID, 'findeo_page_top', TRUE); ?>

<?php 

switch ($page_top) {
	case 'titlebar':
		?>
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
		break;		

	case 'parallax':
		get_template_part( 'template-parts/header','parallax');
		break;	

	case 'off':

		break;
	
	default:
		get_template_part( 'template-parts/header','titlebar');
		break;
}

 ?>
<!-- Titlebar
================================================== -->


<?php
$layout = get_post_meta($post->ID, 'findeo_page_layout', true); if(empty($layout)) { $layout = 'right-sidebar'; }
$class  = ($layout !="full-width") ? "col-md-8" : "col-md-12";
?>
<div class="container <?php echo esc_attr($layout); ?>">

	<!-- Blog Posts -->
	<div class="blog-page">
	<div class="row">


		<!-- Post Content -->
		<div id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>

			<?php
			while ( have_posts() ) : the_post(); ?>

				<div class="blog-post single-post" id="post-<?php the_ID(); ?>">
					<?php get_template_part( 'template-parts/content', 'single' ); ?>
				</div>
				
				<?php

				the_post_navigation(array(
			        'prev_text'          => '<span>'.esc_html__('Previous Post','findeo').'</span> %title',
			        'next_text'          => '<span>'.esc_html__('Next Post','findeo').'</span> %title ',
			        'screen_reader_text' => esc_html__( 'Post navigation','findeo' ),
			    )); ?>
				<div class="margin-top-40"></div>
				<?php
				findeo_author_info_box();

				findeo_related_posts($post->ID); 

				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		
			?>

			<div class="margin-top-50"></div>

	</div>
	<!-- Content / End -->

	<?php if($layout !="full-width") { ?>
		<div class="col-md-4">
			<div class="sidebar right">
				<?php get_sidebar(); ?>
			</div>
		</div>
	<?php } ?>

	</div>
	</div>
	
</div>
<?php get_footer();