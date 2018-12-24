<?php
/**
 * The template for displaying Author info
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

if ( (bool) get_the_author_meta( 'description' ) ) : ?>
<div class="author-bio">
	<h2 class="author-title">
<<<<<<< HEAD
		<span class="author-heading">
			<?php
			printf(
				/* translators: %s: post author */
				__( 'Published by %s', 'twentynineteen' ),
				esc_html( get_the_author() )
			);
			?>
		</span>
=======
		<span class="author-heading"><?php echo esc_html( sprintf( __( 'Published by %s', 'twentynineteen' ), get_the_author() ) ); ?></span>
>>>>>>> 2e44257b6b0e8e00a667e44bb3c1e43a5c74088a
	</h2>
	<p class="author-description">
		<?php the_author_meta( 'description' ); ?>
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php _e( 'View more posts', 'twentynineteen' ); ?>
		</a>
	</p><!-- .author-description -->
</div><!-- .author-bio -->
<?php endif; ?>
