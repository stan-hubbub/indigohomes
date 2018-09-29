<!-- Features -->
<?php   
$term_list = get_the_term_list( $post->ID, 'property_feature' );
if(!empty($term_list)): ?>
<h3 class="desc-headline"><?php esc_html_e('Features','realteo'); ?></h3>
<?php 
echo get_the_term_list( $post->ID, 'property_feature', '<ul class="property-features checkboxes margin-top-0"><li>', '</li><li>', '</li></ul>' );
?>
<?php  endif; ?>