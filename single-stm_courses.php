<?php get_header(); ?>

    <div id="wrapper" class="wrapper">
        <div class="container">
            <?php
            if ( file_exists( get_template_directory() . '/templates/single/' . get_post_type() . '/index.php' ) ) {
                get_template_part( 'templates/single/' . get_post_type() . '/index' );
            } else {
                while ( have_posts() ) :
                    the_post();
                    if ( class_exists( '\STM_CATALOG\Helpers\TemplateManager' ) ) {
                        \STM_CATALOG\Helpers\TemplateManager::display_template();
                    } else {
                        the_content();
                    }
                endwhile;
            }
            ?>
        </div>
    </div>

<?php
get_footer();
