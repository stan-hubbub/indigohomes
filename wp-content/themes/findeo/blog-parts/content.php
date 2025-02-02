<?php $metas =  get_option( 'pp_blog_meta', array('author','date','com') ); ?>
<div <?php post_class('blog-post'); ?> id="post-<?php the_ID(); ?>">
        
    <?php 
    if ( ! post_password_required() ) { 
        if(has_post_thumbnail()) { 
            $thumb = get_post_thumbnail_id();
            $img_url = wp_get_attachment_url( $thumb,'full');

            $image = aq_resize( $img_url, 500, null); 
            //resize & crop the image ?>
            <a  class="post-img" href="<?php the_permalink(); ?>">
                <?php if($image){ ?><img src="<?php echo esc_url($image[0]); ?>" alt=""><?php } else { the_post_thumbnail(); } ?>
            </a>
    <?php } 
    }?>
    
    <!-- Content -->
    <div class="post-content">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

        <?php 

          findeo_posted_on();

          $limit_words = 20;
          $excerpt = get_the_excerpt();
          echo '<p>'.findeo_string_limit_words($excerpt,$limit_words).'</p>';

        ?>
        <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('Read More','findeo'); ?> <i class="fa fa-angle-right"></i></a>
    </div>

</div>