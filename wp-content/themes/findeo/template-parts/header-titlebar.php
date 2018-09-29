<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2><?php the_title(); ?></h2>
                <?php do_action('findeo_page_subtitle') ?>
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