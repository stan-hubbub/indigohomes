<?php
/**
 * The template for displaying search forms in findeo
 *
 * @package findeo
 * @since findeo 1.0
 */
?>
<div class="search-blog-input">
    <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
        <div class="input"><input class="search-field" type="text" name="s" placeholder="<?php esc_attr_e('To search type and hit enter','findeo') ?>" value=""/></div>
	<div class="clearfix"></div>
    </form>
</div>
<div class="clearfix"></div>