<?php
/**
 * Template Name: Properties With Map - Split Page
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

<!-- Content
================================================== -->
<div class="fs-container">

	<div class="fs-inner-container">

		<!-- Map -->
		<div id="map-container">
		    <div id="map" data-map-zoom="4" data-map-scroll="true">
		        <!-- map goes here -->
		    </div>

		    <!-- Map Navigation -->
			<a href="#" id="geoLocation" title="<?php esc_attr_e('Your location','findeo'); ?>"></a>
			<ul id="mapnav-buttons" class="top">
			    <li><a href="#" id="prevpoint" title="<?php esc_attr_e('Previous point on map','findeo'); ?>"><?php esc_html_e('Prev','findeo'); ?></a></li>
			    <li><a href="#" id="nextpoint" title="<?php esc_attr_e('Next point on map','findeo'); ?>"><?php esc_html_e('Next','findeo'); ?></a></li>
			</ul>
		</div>

	</div>


	<div class="fs-inner-container">
		<div class="fs-content">

			<!-- Search -->
			<section class="search margin-bottom-30">

				<div class="row">
					<div class="col-md-12">

						<!-- Title -->
						<h4 class="search-title"><?php esc_html_e('Find Your Home','findeo'); ?>
							<?php if(isset($_GET['keyword_search'])) : ?>	<a id="realteo_reset_filters" href="#"><?php esc_html_e('Reset Filters','findeo'); ?></a> <?php endif; ?>
						</h4>

						<!-- Form -->
						<div class="main-search-box no-shadow">

							<?php echo do_shortcode('[realteo_search_form source="half" more_custom_class="margin-bottom-30"]'); ?>
								<!-- Box / End -->
					</div>
				</div>

			</section>
			<!-- Search / End -->
				<!-- Listings Container -->
			<div class="row fs-listings">
			<?php
			while ( have_posts() ) : the_post();?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12'); ?>>
					<?php the_content(); ?>
				</article>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>


<?php endwhile; // End of the loop. ?>
<?php get_footer('empty'); ?>