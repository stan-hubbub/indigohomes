<?php $template_loader = new Realteo_Template_Loader; ?>
<div class="item">
	<div class="listing-item compact">

		<a href="<?php the_permalink(); ?>" class="listing-img-container">

			<div class="listing-badges">
				<span class="featured"><?php esc_html_e('Featured','realteo'); ?></span>
				<?php the_property_offer_type(); ?>
			</div>

			<div class="listing-img-content">
				<span class="listing-compact-title"><?php the_title(); ?><i><?php the_property_price(); ?></i></span>
				<?php 
				$data = array( 'class' => 'listing-hidden-content' );
				$template_loader->set_template_data( $data )->get_template_part( 'single-partials/single-property','main-details' );  ?>
				
			</div>

			<?php the_post_thumbnail(); ?>
		</a>

	</div>
</div>
<!-- Item / End -->
