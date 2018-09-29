<?php
/**
 * Template Name: Agents list
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WPVoyager
 */

get_header(get_option('header_bar_style','standard') ); 

$layout = get_post_meta($post->ID, 'findeo_page_layout', true); if(empty($layout)) { $layout = 'right-sidebar'; }
$class  = ($layout !="full-width") ? "col-md-8" : "";

$page_top = get_post_meta($post->ID, 'findeo_page_top', TRUE); 

switch ($page_top) {
	case 'titlebar':
		get_template_part( 'template-parts/header','titlebar');
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
<div class="container <?php echo esc_attr($layout); ?>">

	<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
		<div class="row">
			<!-- Main Search Input -->
			<form action="<?php the_permalink(); ?>" method="GET">
				<div class="col-md-12">
					<div class="main-search-input">
					<?php 
					if ( ! empty( $_GET['agent_search'] ) ) {
						$keywords = sanitize_text_field( $_GET['agent_search'] );
					} else {
						$keywords = '';
					} ?>
						<input type="text" class="ico-01" name="agent_search" placeholder="<?php esc_html_e( 'Type an agent name or location' , 'findeo' ); ?>" 
						value="<?php echo esc_attr( $keywords ); ?>"/>
						<button class="button"><?php esc_html_e( 'Search' , 'findeo' ); ?></button>
					</div>
				</div>
			</form>
		</div>
		<div class="row">
			<!-- Agents Container -->
			<div class="agents-grid-container">

			<?php
				$per_page = 10;
				$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

				$args = array(
					'number'  => 999999      
				);
				$user_query = new WP_User_Query( $args );
				$total_pages = count($user_query->get_results()) / $per_page;
 				 
				$args = array(
				  //  'role' => array('Agent'),
				    'orderby' => 'post_count', 
				    'order' => 'DESC',
				   	'number'    => $per_page,
				    'offset'    => $offset,
				  //  'has_published_posts'	 => array('property','post')
				);
				if( isset($_GET['agent_search']) && !empty($_GET['agent_search']) ) {
					$search_term = $_GET['agent_search'];
					$search_args = array(
						
					    'meta_query' => array(
					        'relation' => 'OR',
					        array(
					            'key'     => 'first_name',
					            'value'   => $search_term,
					            'compare' => 'LIKE'
					        ),
					        array(
					            'key'     => 'last_name',
					            'value'   => $search_term,
					            'compare' => 'LIKE'
					        ),
					        array(
					            'key'     => 'description',
					            'value'   => $search_term ,
					            'compare' => 'LIKE'
					        )
					    )
					    );
					$args = array_merge($args,$search_args);
 				}
 			
				$user_query = new WP_User_Query( $args );

				$all_users  = $user_query->get_results();

				// count the number of users found in the query
				$total_users = $all_users ? count($all_users) : 1;

				// grab the current page number and set to 1 if no page number is set
				$page = isset($_GET['p']) ? $_GET['p'] : 1;

				// calculate the total number of pages.
				$total_pages = 1;
				$offset = $per_page * ($page - 1);
				$total_pages = ceil($total_users / $per_page);
				$contact_details_flag = true;
				$contact_details_visibility = realteo_get_option('realteo_agent_contact_details');	
				if( $contact_details_visibility == 'loggedin' ) {
					$contact_details_flag = is_user_logged_in() ? true : false ;
				} 
				if( $contact_details_visibility == 'never' ) {
					$contact_details_flag = false;
				}


				foreach($all_users as $agent) {
				    $agent_info = get_userdata( $agent->ID );
				  
				    $url = get_author_posts_url( $agent->ID );
				    $email = $agent_info->user_email;
				    ?>
				    	<!-- Agent -->
					<div class="grid-item col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<div class="agent">

							<div class="agent-avatar">
								<a href="<?php echo esc_url($url); ?>">
									<?php echo get_avatar($agent->user_email); ?>
									<span class="view-profile-btn"><?php esc_html_e('View Profile','findeo'); ?></span>
								</a>
							</div>

							<div class="agent-content">
								<div class="agent-name">
									<h4><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($agent_info->first_name); ?> <?php echo esc_html($agent_info->last_name); ?></a></h4>
									<?php if( isset( $agent_info->agent_title ) ) : ?><span><?php echo esc_html($agent_info->agent_title); ?></span><?php endif; ?>
								</div>
								<?php 
								if($contact_details_flag) { ?>
								<ul class="agent-contact-details">
									<?php if(isset($agent_info->phone) && !empty($agent_info->phone)): ?><li><i class="sl sl-icon-call-in"></i><a href="tel:<?php echo esc_html($agent_info->phone); ?>"><?php echo esc_html($agent_info->phone); ?></a></li><?php endif; ?>
									<?php $email_flag = realteo_get_option('realteo_agent_contact_email');
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
					<!-- Agent / End -->
				    <?php 
				    
				}

?>
		<div class="pagination-container margin-top-45 margin-bottom-60">
			<nav class="pagination">
			<?php
				echo paginate_links( array(
					'base'          => '%_%',
								
				    'format' => '&p=%#%', // this defines the query parameter that will be used, in this case "p"
				    'prev_text' => __('&laquo; Previous','findeo'), // text for previous page
				    'next_text' => __('Next &raquo;','findeo'), // text for next page
				    'total' => $total_pages, // the total number of pages we have
				    'current' => $page, // the current page
				    'end_size' => 1,
				    'mid_size' => 5,
				)); ?>
			</nav>
		</div>

		</div>
	</article>
		
		<?php if($layout !="full-width") { ?>
			<div class="col-md-4">
				<div class="sidebar right">
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php } ?>


</div>
<div class="clearfix"></div>

<div class="margin-top-55"></div>

<?php get_footer(); 