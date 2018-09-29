<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package findeo
 */

get_header(get_option('header_bar_style','standard') ); 

?>
<!-- Titlebar
================================================== -->
<div class="header-container with-titlebar basic" >

    <div id="titlebar" class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2><?php esc_html_e( 'Page Not Found', 'findeo' ); ?></h2>
                    
                    <?php if(function_exists('bcn_display')) { ?>
                        <nav id="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                            <ul>
                                <?php bcn_display_list(); ?>
                            </ul>
                        </nav>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="clearfix"></div>

<div class="container">

	<div class="row">
    	<div class="col-md-12">
    		<section id="not-found" class="margin-bottom-50">
    			<h2>404 <i class="fa fa-question-circle"></i></h2>
    			<p><?php _e( 'We&rsquo;re sorry, but the page you were looking for doesn&rsquo;t exist..', 'findeo' ); ?></p>
    			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button center border medium margin-top-30"><?php _e( 'Back to Homepage', 'findeo' ); ?></a>
    		</section>
    	</div>
	</div>

</div>

<?php
get_footer();