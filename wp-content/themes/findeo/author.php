<?php
/**
 * The template for displaying author archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package findeo
 */

get_header(get_option('header_bar_style','standard') ); 
$template_loader = new Realteo_Template_Loader; 

$contact_details_flag = true;
$contact_details_visibility = realteo_get_option('realteo_agent_contact_details');	

if( $contact_details_visibility == 'loggedin' ) {
	$contact_details_flag = is_user_logged_in() ? true : false ;
} 
if( $contact_details_visibility == 'never' ) {
	$contact_details_flag = false;
}

$agent = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
$agent_info = get_userdata( $agent->ID );
$email = $agent_info->user_email;
?>
<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2><?php echo esc_html($agent_info->first_name); ?> <?php echo esc_html($agent_info->last_name); ?></h2>
                <?php if( isset( $agent_info->agent_title ) ) : ?><span><?php echo esc_html($agent_info->agent_title); ?></span><?php endif; ?>

            </div>
        </div>
    </div>
</div>

<!-- Content
================================================== -->
<div class="container">
	<div class="row">

		<div class="col-md-12">
			<div class="agent agent-page">

				<div class="agent-avatar">
					<?php echo get_avatar($agent->ID,'full'); ?>
				</div>

				<div class="agent-content">
					<div class="agent-name">
						<h4><?php echo esc_html($agent_info->first_name); ?> <?php echo esc_html($agent_info->last_name); ?></h4>
						<span><?php echo esc_html($agent_info->agent_title); ?></span>
					</div>

					<p>
						<?php 
					 	$allowed_tags = wp_kses_allowed_html( 'post' );
              			echo wp_kses($agent->description,$allowed_tags);
   						?>
   					</p>
					<?php if($contact_details_flag) { ?>
					<ul class="agent-contact-details">
						<?php if(isset($agent_info->phone) && !empty($agent_info->phone)): ?>
							<li><i class="sl sl-icon-call-in"></i><a href="tel:<?php echo esc_html($agent_info->phone); ?>"><?php echo esc_html($agent_info->phone); ?></a></li>
						<?php endif; ?>

						<?php
						$email_flag = realteo_get_option('realteo_agent_contact_email');
						if($email_flag != 'on' && isset($agent_info->user_email)): ?>
							<li><i class="fa fa-envelope-o "></i><a href="mailto:<?php echo esc_attr($email);?>"><?php echo esc_html($email);?></a></li>
						<?php endif; ?>
					</ul>
					<?php } ?>

					<ul class="social-icons">
						<?php
							$socials = array('facebook','twitter','gplus','linkedin');
							foreach ($socials as $social) {
								$social_value = get_user_meta($agent->ID, $social, true);
								if(!empty($social_value)){ ?>
									<li><a class="<?php echo esc_attr($social); ?>" href="<?php echo esc_url($social_value); ?>"><i class="icon-<?php echo esc_attr($social); ?>"></i></a></li>
								<?php }
							}
						?>
					</ul>
					<div class="clearfix"></div>
				</div>

			</div>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row sticky-wrapper">

		<div class="col-md-8">
			

			<div class="row margin-bottom-15">
				<?php do_action( 'realto_before_archive' ); ?>
			</div>

			
				<!-- Listings -->
				<div class="listings-container list-layout">
				<?php
				if ( have_posts() ) : 

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						$template_loader->get_template_part( 'content-property' ); 

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/author-content-none' );

				endif; ?>	
				</div>
				<div class="margin-top-60"></div>
		</div>
		<!-- Sidebar
		================================================== -->
		<div class="col-md-4">
			<?php $template_loader->get_template_part( 'sidebar-realteo' );?>
		</div>
	<!-- Sidebar / End -->
	</div>
</div>

<?php get_footer(); ?>